
<?php
session_start();
if (isset($_SESSION['username'])) {
    echo "Logged in as: " . $_SESSION['username'];
} else {
    echo "No session data found.";  // If the session isn't set, the user isn't logged in
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simplestore</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        color: #333;
      }

      .hero-section {
        background: url('images/hero-bg.jpg') no-repeat center center/cover;
        height: 400px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
      }

      .hero-section h1 {
        font-size: 3rem;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
      }

      footer {
        background-color: #28a745;
        color: white;
        padding: 20px 0;
        text-align: center;
      }

      footer a {
        color: white;
        text-decoration: underline;
      }

      @media (max-width: 768px) {
        .hero-section h1 {
          font-size: 2rem;
        }
      }
    </style>
  </head>
  <body>
    <!-- Include Navbar -->
    <?php include 'includes/navbar.php'; ?>

    <!-- Hero Section -->
    <section class="hero-section">
      <div class="container">
        <h1>Welcome to Simplestore</h1>
        <p>Your one-stop shop for everything!</p>
      </div>
    </section>

    <!-- Content -->
    <div class="container mt-5">
      <div class="row text-center">
        <div class="col-md-4">
          <img src="images/featured-1.jpg" class="img-fluid rounded" alt="Featured Product 1">
          <h4 class="mt-3">Featured Product 1</h4>
        </div>
        <div class="col-md-4">
          <img src="images/featured-2.jpg" class="img-fluid rounded" alt="Featured Product 2">
          <h4 class="mt-3">Featured Product 2</h4>
        </div>
        <div class="col-md-4">
          <img src="images/featured-3.jpg" class="img-fluid rounded" alt="Featured Product 3">
          <h4 class="mt-3">Featured Product 3</h4>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer>
      <div class="container">
        <p>&copy; 2025 Simplestore. All Rights Reserved. | <a href="terms.php">Terms of Service</a></p>
        <p><a href="https://www.facebook.com">Facebook</a> | <a href="https://www.twitter.com">Twitter</a></p>
      </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
