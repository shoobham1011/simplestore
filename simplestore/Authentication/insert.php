<?php
session_start();
include '../config.php';  // Include your database configuration file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the form data
    $fname = $mysqli->real_escape_string($_POST['fname']);
    $lname = $mysqli->real_escape_string($_POST['lname']);
    $address = $mysqli->real_escape_string($_POST['address']);
    $city = $mysqli->real_escape_string($_POST['city']);
    $pin = $mysqli->real_escape_string($_POST['pin']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $_POST['pwd'];  // Password will be hashed

    // Check if the email already exists
    $query = "SELECT email FROM users WHERE email = '$email'";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        // Email already exists
        echo "<script>alert('This email is already registered. Please choose another one.'); window.location.href='register.php';</script>";
    } else {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  // Using bcrypt

        // Insert the new user into the database
        $insertQuery = "INSERT INTO users (fname, lname, address, city, pin, email, password, type) 
                        VALUES ('$fname', '$lname', '$address', '$city', '$pin', '$email', '$hashedPassword', 'user')";

        if ($mysqli->query($insertQuery) === TRUE) {
            // Registration successful, redirect to login page
            echo "<script>alert('Registration successful! Please log in.'); window.location.href='login.php';</script>";
        } else {
            // Error inserting into database
            echo "<script>alert('There was an error during registration. Please try again later.'); window.location.href='register.php';</script>";
        }
    }
}
?>
