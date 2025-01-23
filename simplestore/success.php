<?php
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Success || Simplestore</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
      }

      .success-container {
        margin-top: 50px;
        padding: 30px;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
      }

      .success-container h1 {
        font-size: 2.5rem;
        color: #28a745;
      }

      .success-container p {
        font-size: 1.2rem;
        color: #555;
      }

      .btn-primary {
        background-color: #28a745;
        border: none;
        font-size: 1rem;
        font-weight: bold;
        padding: 10px 20px;
        transition: background-color 0.3s ease;
      }

      .btn-primary:hover {
        background-color: #218838;
      }

      footer {
        margin-top: 50px;
        background-color: #28a745;
        color: white;
        padding: 20px 0;
        text-align: center;
      }

      footer a {
        color: white;
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <!-- Include Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Success Message -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="success-container">
            <i class="fas fa-check-circle fa-4x mb-4" style="color: #28a745;"></i>
            <h1>Success!</h1>
            <p>Your action was completed successfully.</p>
            <p>If you made a purchase, please check your email (including the spam folder) for the receipt.</p>
            <a href="products.php" class="btn btn-primary mt-4">Continue Shopping</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer>
      <div class="container">
        <p>&copy; 2025 Simplestore. All Rights Reserved. | <a href="terms.php">Terms of Service</a></p>
      </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
