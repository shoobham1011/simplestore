<?php
// Start session if not already active
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}

// Redirect to login page if user is not logged in
if (!isset($_SESSION["username"])) {
    header("location:/simplestore/Authentication/login.php");
}

include '../config.php'; // Include the database configuration

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>simple shop</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Include Navbar -->
    <?php include '../includes/navbar.php'; ?>

    <div class="container mt-5">
        <h3>My COD Orders</h3>
        <hr>

        <?php
        $user = $_SESSION["username"];
        $result = $mysqli->query("SELECT * from orders WHERE email='".$user."'");

        if ($result && $result->num_rows > 0) {
            while ($obj = $result->fetch_object()) {
                echo '<div class="card mb-3">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">Order ID: ' . $obj->id . '</h5>';
                echo '<p><strong>Date of Purchase</strong>: ' . $obj->date . '</p>';
                echo '<p><strong>Product Code</strong>: ' . $obj->product_code . '</p>';
                echo '<p><strong>Product Name</strong>: ' . $obj->product_name . '</p>';
                echo '<p><strong>Price Per Unit</strong>: ' . $currency . $obj->price . '</p>';
                echo '<p><strong>Units Bought</strong>: ' . $obj->units . '</p>';
                echo '<p><strong>Total Cost</strong>: ' . $currency . $obj->total . '</p>';
                // If you want to display the product image
                echo '<img src="../images/products/' . $obj->product_image . '" class="img-fluid" alt="' . $obj->product_name . '">';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="alert alert-warning">You have no orders yet.</div>';
        }
        ?>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">&copy; 2025 BOLT Sports Shop. All Rights Reserved.</span>
        </div>
    </footer>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
