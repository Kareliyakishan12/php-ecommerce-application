<?php
require_once('db_connect.php');
require_once('function_inc.php');

if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
    $customerId = $_SESSION['Customer_Id'];
}
if (isset($_POST['p_id']) && !empty($_POST['p_id'])) {

    $productId = $_POST['p_id'];


    $sql = "DELETE FROM `cart` WHERE `Product_Id`=$productId";

    if (mysqli_query($conn, $sql)) {
        echo true;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
