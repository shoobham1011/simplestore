<?php
$currency = '$';

// Database credentials
$servername = "localhost";  // Database server
$username = "root";         // MySQL username (default is "root" for XAMPP)
$password = "";             // MySQL password (default is empty for XAMPP)
$dbname = "simplestore";    // Your database name

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    // Provide a more detailed error message
    die("Connection failed: " . $mysqli->connect_error);
}



?>
