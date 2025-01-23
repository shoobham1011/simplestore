<?php
session_start();

// Check if the cart is set and return the count
if (isset($_SESSION['cart'])) {
    echo count($_SESSION['cart']);  // Return the number of items in the cart
} else {
    echo 0;  // If the cart is empty or not set, return 0
}
?>
