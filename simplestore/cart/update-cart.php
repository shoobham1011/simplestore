<?php
session_start();
include '../config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$action = $_GET['action'] ?? '';

if ($action === 'add') {
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
} elseif ($action === 'remove' && isset($_SESSION['cart'][$id])) {
    unset($_SESSION['cart'][$id]);
}

header("location: cart.php");
exit();
