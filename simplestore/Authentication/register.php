<?php
// Start session if not already active
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["username"])) {
    header("location:index.php");
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register || Simplestore</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
      }

      .form-section {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
      }

      .btn-primary {
        background-color: #28a745;
        border: none;
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: bold;
        transition: background-color 0.3s ease;
      }

      .btn-primary:hover {
        background-color: #218838;
      }

      .btn-secondary {
        background-color: #dc3545;
        border: none;
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: bold;
        transition: background-color 0.3s ease;
      }

      .btn-secondary:hover {
        background-color: #c82333;
      }
    </style>
  </head>
  <body>
    <!-- Include Navbar -->
    <?php include '../includes/navbar.php'; ?>

    <!-- Register Form -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="form-section">
            <h2 class="text-center mb-4">Create Your Account</h2>
            <form method="POST" action="/simplestore/Authentication/insert.php" id="registerForm">
              <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter your first name" required>
              </div>
              <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter your last name" required>
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
              </div>
              <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" required>
              </div>
              <div class="mb-3">
                <label for="pin" class="form-label">Pin Code</label>
                <input type="text" class="form-control" id="pin" name="pin" placeholder="Enter your pin code" required pattern="\d{6}">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                <small id="emailHelp" class="text-danger"></small>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="pwd" placeholder="Enter your password" required>
              </div>
              <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Register</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5 text-center">
      <p>&copy; 2025 Simplestore. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Email Validation Script -->
    <script>
      document.getElementById('email').addEventListener('input', function () {
        const email = this.value;
        const emailHelp = document.getElementById('emailHelp');
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!regex.test(email)) {
          emailHelp.textContent = 'Please enter a valid email address.';
        } else {
          emailHelp.textContent = '';
        }
      });
    </script>
  </body>
</html>
