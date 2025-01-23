<?php
// Start session if not already active
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}

// Include the navbar directly
include 'includes/navbar.php';  // Corrected path if navbar.php is in 'includes/'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us || SimpleStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>About Us</h2>
        <p>Welcome to SimpleStore! We are committed to providing an exceptional shopping experience by offering high-quality products and outstanding customer service.</p>
        <p>Our mission is to empower shoppers and small business owners by making online shopping easy, efficient, and enjoyable. Whether you are an individual looking for your next purchase or a business aiming to expand your reach, SimpleStore is here for you.</p>
        <p>Join us as we continue to innovate and improve our services, ensuring that SimpleStore remains your preferred online shopping destination.</p>
    </div>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">&copy; 2025 SimpleStore. All Rights Reserved.</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
