<?php
require("db_connect_inc.php");
require("function_inc.php");

if (isset($_GET['table']) && isset($_GET['id'])) {
    $table_name = get_safe_value($conn, $_GET['table']);
    $id = get_safe_value($conn, $_GET['id']);

    switch ($table_name) {
        case 'category':
            $sql = "DELETE FROM category WHERE Category_Id = $id";
            break;
        case 'brand':
            $sql = "DELETE FROM brand WHERE Brand_Id = $id";
            break;
        case 'product':
            $sql = "DELETE FROM product WHERE Product_Id = $id";
            break;
        case 'product_features':
            $sql = "DELETE FROM `product_features` WHERE Product_Features_Id = $id";
            break;
        case 'delivery_person':
            $sql = "DELETE FROM `delivery_person` WHERE Delivery_Person_Id = $id";
            break;
        case 'customer':
            $sql = "DELETE FROM `customer` WHERE Customer_Id = $id";
    }

    if (mysqli_query($conn, $sql)) {
        $_SESSION['delete_msg'] = "$table_name Deleted successfully!";

        if ($table_name == "product_features") {
            redirect("add_category_features.php");
            exit();
        } else {
            redirect("display_$table_name.php");
            exit();
        }
    }
}
