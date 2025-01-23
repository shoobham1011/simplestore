<?php
if(session_id() == '' || !isset($_SESSION)){ 
    session_start(); 
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact || Simplestore</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS for additional styles -->
    <link rel="stylesheet" href="css/style.css">
    <style>
      body {
        background-color: #f8f9fa;
        color: #000;
      }
      .btn-success {
        background-color: #343a40;
        border-color: #343a40;
      }
      .btn-success:hover {
        background-color: #212529;
        border-color: #212529;
      }
      .footer {
        background-color: #343a40;
        color: #fff;
      }
    </style>
  </head>
  <body>
    <!-- Navbar included -->
    <?php include('includes/navbar.php'); ?>

    <!-- Contact Section -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Get In Touch</h2>
        <p class="text-center mb-4">We’d love to hear from you! Please fill out the form below, or reach out via email.</p>

        <!-- Contact Form -->
        <form action="contactsubmit.php" method="POST">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <!-- Name Input -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <!-- Subject Input -->
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" required>
                    </div>
                    <!-- Message Input -->
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea id="message" name="message" class="form-control" placeholder="Your Message" rows="6" required></textarea>
                    </div>
                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">Send Message</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Contact Info Section -->
        <div class="text-center mt-5">
            <h3>Other Ways to Reach Us</h3>
            <p>If you prefer, you can also contact us via email:</p>
            <p><a href="mailto:support@simplestore.com" class="btn btn-link">support@simplestore.com</a></p>
        </div>

    </div>

    <!-- Footer -->
    <footer class="footer text-center py-4 mt-5">
        <p>&copy; 2025 Simplestore. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
