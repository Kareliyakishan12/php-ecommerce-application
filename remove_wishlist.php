<?php
require_once('db_connect.php');
require_once('function_inc.php');

if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
    $customerId = $_SESSION['Customer_Id'];
}
if (isset($_POST['w_id']) && !empty($_POST['w_id'])) {

    $wishlistId = $_POST['w_id'];


    $sql = "DELETE FROM `wishlist` WHERE `Wishlist_Id`=$wishlistId";

    if (mysqli_query($conn, $sql)) {
        echo true;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
