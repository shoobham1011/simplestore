<?php
session_start();
include '../config.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Cart || Simplestore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f8f8;
        }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .cart-item img {
            max-height: 80px;
            margin-right: 15px;
        }

        .btn {
            background-color: #000;
            color: #fff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #333;
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
    <?php include '../includes/navbar.php'; ?>

    <div class="container mt-5">
        <h2>Your Cart</h2>
        <div class="cart-container">
            <?php
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $quantity) {
                    $result = $mysqli->query("SELECT * FROM products WHERE id = $id");
                    if ($result) {
                        $product = $result->fetch_object();
                        echo '<div class="cart-item">';
                        echo '<img src="../images/products/' . $product->product_img_name . '" alt="' . $product->product_name . '">';
                        echo '<div><strong>' . $product->product_name . '</strong><br>Quantity: ' . $quantity . '<br>Price: $' . number_format($product->price, 2) . '</div>';
                        echo '<a href="update-cart.php?id=' . $id . '&action=remove" class="btn">Remove</a>';
                        echo '</div>';
                    }
                }
            } else {
                echo '<p>Your cart is empty.</p>';
            }
            ?>
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Display Checkout button if user is logged in -->
            <a href="checkout.php" class="btn mt-4">Checkout</a>
        <?php else: ?>
            <!-- Display Login button if user is not logged in -->
            <a href="/simplestore/Authentication/login.php" class="btn mt-4">Login</a>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2025 Simplestore. All Rights Reserved.</p>
    </footer>
</body>
</html>
