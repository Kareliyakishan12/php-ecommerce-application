<?php
require_once('db_connect.php');
require_once('function_inc.php');


if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
    $customerId = $_SESSION['Customer_Id'];
} else {
    $_SESSION['login_msg'] = "Please Login To Add Item In wishlist";
    echo false;
    exit();
}
if (isset($_POST['p_id']) && !empty($_POST['p_id'])) {

    $productId = $_POST['p_id'];

    $sql = "INSERT INTO `wishlist`(`Product_Id`, `Customer_Id`) VALUES ('$productId','$customerId')";

    if (mysqli_query($conn, $sql)) {
        echo true;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
