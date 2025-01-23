<?php
session_start();  // Start the session

include '../config.php';  // Include the database configuration

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get login credentials from the form
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    // Sanitize inputs to prevent SQL injection
    $email = $mysqli->real_escape_string($email);
    $password = $mysqli->real_escape_string($password);

    // Query the database for the user with the provided email
    $query = "SELECT id, email, password, fname, type FROM users WHERE email = '$email'";
    $result = $mysqli->query($query);

    // Check if the query was successful and if the user is found
    if ($result && $user = $result->fetch_object()) {
        // Verify the password using password_verify() to check against the hash in the database
        if (password_verify($password, $user->password)) {
            // If password matches, start the session and set session variables
            $_SESSION['username'] = $email;
            $_SESSION['id'] = $user->id;
            $_SESSION['fname'] = $user->fname;
            $_SESSION['type'] = $user->type;  // Store user type (role)

            // Redirect based on user role (admin or regular user)
            if ($user->type == 'admin') {
                header("Location: /simplestore/products/products.php");  // Admin dashboard
            } else {
                header("Location: /simplestore/index.php");  // Regular user homepage
            }
            exit();  // Always call exit() after header() to prevent further script execution
        } else {
            // Invalid password
            echo "<script>alert('Invalid email or password.'); window.location.href='login.php';</script>";
        }
    } else {
        // Invalid email
        echo "<script>alert('Invalid email or password.'); window.location.href='login.php';</script>";
    }
}
?>
