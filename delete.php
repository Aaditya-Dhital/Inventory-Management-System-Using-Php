<?php
//Delete a product
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM products WHERE id='$id'") or die("Error");
    $_SESSION['message'] = "Product deleted.";
}
header("Location: index.php");
exit();
?>
