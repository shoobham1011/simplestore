<?php
session_start();
include '../config.php';

$result = $mysqli->query('SELECT * FROM products');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products || Simplestore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: #333;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            background-color: #fff;
            transition: box-shadow 0.3s ease;
        }

        .product-card:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            max-height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .btn {
            background-color: #000;
            color: #fff;
            border: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #333;
        }

        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: none;
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #000;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include '../includes/navbar.php'; ?>

    <div class="alert" id="cart-alert">Product added to cart!</div>

    <div class="container mt-5">
        <div class="row g-4">
            <?php
            if ($result) {
                while ($obj = $result->fetch_object()) {
                    echo '<div class="col-md-4">';
                    echo '<div class="product-card">';
                    echo '<h5>' . $obj->product_name . '</h5>';
                    echo '<img src="../images/products/' . $obj->product_img_name . '" alt="' . $obj->product_name . '">';
                    echo '<p><strong>Price:</strong> $' . number_format($obj->price, 2) . '</p>';
                    echo '<button class="btn add-to-cart" data-id="' . $obj->id . '">Add to Cart</button>';
                    echo '<a href="viewdetial.php?id=' . $obj->id . '" class="btn mt-2">View Details</a>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Simplestore. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".add-to-cart").click(function () {
                const productId = $(this).data("id");
                $.ajax({
                    url: "/simplestore/cart/update-cart.php",
                    method: "GET",
                    data: { id: productId, action: "add" },
                    success: function () {
                        $("#cart-alert").fadeIn().delay(2000).fadeOut();
                        updateCartCount();
                    },
                    error: function () {
                        alert("Error adding product to cart.");
                    },
                });
            });

            function updateCartCount() {
                $.ajax({
                    url: "/simplestore/cart/cart_count.php",
                    method: "GET",
                    success: function (data) {
                        $("#cart_count").text(data);
                    },
                });
            }

            updateCartCount();
        });
    </script>
</body>
</html>
