<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Database connection
    $host = 'localhost';
    $db = 'simplestore'; // Replace with your database name
    $user = 'root'; // Replace with your database username
    $pass = ''; // Replace with your database password

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert data into the contact_form table
        $sql = "INSERT INTO contact_form (name, email, subject, message) VALUES (:name, :email, :subject, :message)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);
        $stmt->execute();

        // Success: Show the alert with a message
        echo "<script type='text/javascript'>alert('Your message has been sent successfully!'); window.location.href='contact.php';</script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    $pdo = null;
}
?>
