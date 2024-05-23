<?php
require_once('db_connect_inc.php');

if (isset($_POST['delivery_person_id']) && isset($_POST['order_id']) && $_POST['delivery_person_id'] != null && $_POST['order_id'] != null) {
    $order_id = $_POST['order_id'];
    $delivery_person_id = $_POST['delivery_person_id'];

    $sql = "UPDATE `product_order` SET `Delivery_Person_Id`='$delivery_person_id' WHERE `Order_Id`='$order_id'";
    if (mysqli_query($conn, $sql)) {
        echo true;
    } else {
        echo false;
    }
}
