<?php
session_start();
include '../config.php';

// Ensure cart exists in the session
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: /simplestore/cart/cart.php");
    exit();
}

// Calculate total price and prepare product data for insertion
$totalPrice = 0;
$orderDetails = [];
foreach ($_SESSION['cart'] as $product_id => $quantity) {
    $result = $mysqli->query("SELECT * FROM products WHERE id = $product_id");
    if ($result && $product = $result->fetch_object()) {
        $totalPrice += $product->price * $quantity;
        $orderDetails[] = [
            'product_code' => $product->product_code,
            'product_name' => $product->product_name,
            'price' => $product->price,
            'quantity' => $quantity,
            'total' => $product->price * $quantity
        ];
    }
}

// Handle payment and saving the order to the database
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment_status'])) {
    $payment_status = $_POST['payment_status'];
    $email = $_SESSION['username']; // Assuming the username is the email

    if ($payment_status === 'success') {
        // Save each product in the cart to the orders table
        foreach ($orderDetails as $order) {
            $stmt = $mysqli->prepare("INSERT INTO orders (product_code, product_name, price, units, total, date, email) VALUES (?, ?, ?, ?, ?, NOW(), ?)");
            $stmt->bind_param('ssdiis', $order['product_code'], $order['product_name'], $order['price'], $order['quantity'], $order['total'], $email);
            $stmt->execute();
        }

        // Clear the cart after successful payment
        unset($_SESSION['cart']);

        // Redirect to order confirmation page
        header("Location: /simplestore/order/orders.php");
        exit();
    } else {
        // Payment failed
        echo '<p>Payment Declined</p>';
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout || Simplestore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .payment-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            z-index: 1000;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
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
        <div class="row">
            <?php
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                $result = $mysqli->query("SELECT * FROM products WHERE id = $product_id");
                if ($result && $product = $result->fetch_object()) {
                    echo '<div class="col-md-6 cart-item">';
                    echo '<h5>' . $product->product_name . '</h5>';
                    echo '<p>Price: ' . $product->price . ' x ' . $quantity . ' = ' . ($product->price * $quantity) . '</p>';
                    echo '</div>';
                }
            }
            ?>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h4>Total: <?php echo $totalPrice; ?></h4>
            </div>
        </div>

        <!-- Proceed to Payment Button -->
        <button class="btn btn-primary mt-4" id="proceed-to-payment">Proceed to Payment</button>
    </div>

    <!-- Payment Popup -->
    <div class="overlay" id="overlay"></div>
    <div class="payment-popup" id="payment-popup">
        <h4>Enter Card Details</h4>
        <form id="payment-form" method="POST">
            <div class="mb-3">
                <label for="card-number" class="form-label">Card Number</label>
                <input type="text" id="card-number" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="exp-date" class="form-label">Expiration Date</label>
                <input type="text" id="exp-date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="cvv" class="form-label">CVV</label>
                <input type="text" id="cvv" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Pay Now</button>
            <input type="hidden" name="payment_status" value="" id="payment-status">
        </form>
        <div id="payment-message"></div>
    </div>

    <footer>
        <p>&copy; 2025 Simplestore. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Show the payment popup
        $('#proceed-to-payment').click(function() {
            $('#overlay').fadeIn();
            $('#payment-popup').fadeIn();
        });

        // Close the payment popup
        $('#overlay').click(function() {
            $('#overlay').fadeOut();
            $('#payment-popup').fadeOut();
        });

        // Handle form submission
        $('#payment-form').submit(function(event) {
            event.preventDefault();

            // Get card number
            var cardNumber = $('#card-number').val();

            // Simulate payment process
            if (cardNumber === '1234567812345678') {
                $('#payment-message').html('<p class="text-success">Payment Successful!</p>');
                // Set payment status to success and submit the form
                $('#payment-status').val('success');
                setTimeout(function() {
                    $(this).closest('form').submit(); // Submit the form
                }, 2000);
            } else {
                $('#payment-message').html('<p class="text-danger">Payment Declined. Invalid card number.</p>');
                $('#payment-status').val('failure');
            }
        });
    </script>
</body>
</html>
