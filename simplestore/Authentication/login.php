<?php
session_start();  // Start session to check if the user is already logged in

// Redirect to home page if already logged in
if (isset($_SESSION['username'])) {
    header("Location: /simplestore/index.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login || Simplestore</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .form-section {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .form-section h2 {
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            font-size: 1rem;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        footer {
            background-color: #28a745;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <?php include '../includes/navbar.php'; ?>

    <!-- Login Form -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-section">
                    <h2>Login to Simplestore</h2>
                    <form method="POST" action="verify.php">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="pwd" placeholder="Enter your password" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">Login</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                    <p class="mt-3 text-center">
                        Don't have an account? <a href="register.php" class="text-success">Register here</a>
                    </p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
