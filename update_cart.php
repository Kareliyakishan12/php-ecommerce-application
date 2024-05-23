<?php

require_once('db_connect.php');
require_once('function_inc.php');

if (
    isset($_POST['productId'], $_POST['newQuantity']) && !empty($_POST['productId']) && !empty($_POST['newQuantity'])
) {

    $productId = $_POST['productId'];
    $newQty = $_POST['newQuantity'];


    $sql = "UPDATE `cart` SET `Quantity`='$newQty' WHERE `Product_Id`='$productId'";

    if (mysqli_query($conn, $sql)) {
        echo true;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
