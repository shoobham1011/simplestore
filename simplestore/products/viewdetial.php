<?php
session_start();
include '../config.php';

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id <= 0) {
    header("Location: /simplestore/products/products.php");
    exit();
}

$result = $mysqli->query("SELECT * FROM products WHERE id = $product_id");
if ($result && $product = $result->fetch_object()) {
    // Product details found
} else {
    header("Location: /simplestore/products/products.php");
    exit();
}

// Handle review submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['username'])) {
        $user_id = $_SESSION['id']; // Assuming the user's ID is stored in the session
        $rating = $_POST['rating'];
        $review = $_POST['review'];

        if ($rating >= 1 && $rating <= 5 && !empty($review)) {
            $stmt = $mysqli->prepare("INSERT INTO reviews (product_id, user_id, rating, review) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiis", $product_id, $user_id, $rating, $review);
            $stmt->execute();
            echo "<script>alert('Review submitted successfully!');</script>";
        } else {
            echo "<script>alert('Invalid rating or review.');</script>";
        }
    } else {
        echo "<script>alert('You must be logged in to leave a review.');</script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $product->product_name; ?> || Simplestore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f8f8;
        }

        .product-detail {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .product-detail img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #000;
            color: #fff;
            border: none;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #333;
        }

        .star-rating {
            font-size: 30px;
            color: gray; /* Gray stars initially */
            cursor: pointer;
        }

        .star-rating .star.filled {
            color: #ffcc00;
        }

        .review-form {
            margin-top: 30px;
            width: 60%;
        }

        footer {
            background-color: #000;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 30px;
        }

        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: none;
            padding: 10px;
            border-radius: 5px;
            background-color: #28a745;
            color: #fff;
            font-size: 0.9rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <?php include '../includes/navbar.php'; ?>

    <div class="container">
        <div class="product-detail">
            <h2><?php echo $product->product_name; ?></h2>
            <img src="../images/products/<?php echo $product->product_img_name; ?>" alt="<?php echo $product->product_name; ?>" width="200em">
            <p><strong>Price:</strong> $<?php echo number_format($product->price, 2); ?></p>
            <p><strong>Description:</strong> <?php echo $product->product_desc; ?></p>
            <p><strong>Code:</strong> <?php echo $product->product_code; ?></p>

            <a href="update-cart.php?id=<?php echo $product->id; ?>&action=add" class="btn mt-4">Add to Cart</a>
        </div>

        <!-- Review Section -->
        <h3>Leave a Review</h3>
        <?php if (isset($_SESSION['username'])): ?>
            <!-- Display Review Form if User is Logged In -->
            <div class="review-form">
                <form method="POST">
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label><br>
                        <div class="star-rating" id="star-rating">
                            <span class="star" data-rating="1">&#9733;</span>
                            <span class="star" data-rating="2">&#9733;</span>
                            <span class="star" data-rating="3">&#9733;</span>
                            <span class="star" data-rating="4">&#9733;</span>
                            <span class="star" data-rating="5">&#9733;</span>
                        </div>
                        <input type="hidden" name="rating" id="rating" value="">
                    </div>
                    <div class="mb-3">
                        <label for="review" class="form-label">Review</label>
                        <textarea id="review" name="review" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn">Submit Review</button>
                </form>
            </div>
        <?php else: ?>
            <!-- Display Message if User is Not Logged In -->
            <div class="alert alert-info">
                Please log in to leave a review.
            </div>
        <?php endif; ?>

        <!-- Display Reviews -->
        <div class="reviews mt-5">
            <h4>Customer Reviews</h4>
            <?php
            $reviews = $mysqli->query("SELECT * FROM reviews WHERE product_id = $product_id ORDER BY created_at DESC");
            while ($review = $reviews->fetch_object()) {
                $user_result = $mysqli->query("SELECT * FROM users WHERE id = $review->user_id");
                $user = $user_result->fetch_object();
                echo "<div class='review'>";
                echo "<p><strong>" . $user->fname . " " . $user->lname . "</strong> - " . date("F j, Y, g:i a", strtotime($review->created_at)) . "</p>";
                echo "<p>Rating: <span class='star-rating'>";
                for ($i = 0; $i < $review->rating; $i++) {
                    echo "&#9733;";
                }
                echo "</span></p>";
                echo "<p>" . $review->review . "</p>";
                echo "</div><hr>";
            }
            ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Simplestore. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            // Handle Star Rating
            $(".star").click(function () {
                const rating = $(this).data("rating");
                $("#rating").val(rating);
                $(".star").removeClass("filled");
                $(this).prevAll().addClass("filled");
                $(this).addClass("filled");
            });
        });
    </script>
</body>
</html>
