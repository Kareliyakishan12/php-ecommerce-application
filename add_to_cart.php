<?php
require_once('db_connect.php');
require_once('function_inc.php');


if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
    $customerId = $_SESSION['Customer_Id'];
} else {
    $_SESSION['login_msg'] = "Please Login To Add Item In cart";
    echo false;
    exit();
}
if (isset($_POST['p_id'], $_POST['price'], $_POST['qty']) && !empty($_POST['p_id']) && !empty($_POST['price']) && !empty($_POST['qty'])) {

    $productId = $_POST['p_id'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];


    $sql = "INSERT INTO `cart`(`Product_Id`, `Customer_Id`, `Quantity`, `Price`) VALUES ('$productId','$customerId','$qty','$price')";

    if (mysqli_query($conn, $sql)) {
        echo true;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}