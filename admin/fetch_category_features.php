<?php
require('db_connect_inc.php');
require('function_inc.php');

if (isset($_GET['category_id'])) {
    $category_id = get_safe_value($conn, $_GET['category_id']);

    $query = "SELECT * FROM product_features WHERE category_id = $category_id";
    $result = mysqli_query($conn, $query);

    $table = "";
    $counter = 1;
    if (mysqli_num_rows($result) > 0) {
        $table = '';

        while ($row = mysqli_fetch_assoc($result)) {
            $table .= "<tr>
                <th scope=\"row\">{$counter}</th>
                <td>{$row['Product_Features_Name']}</td>
                <td colspan=\"2\">
                <a href=\"delete_table_row.php?table=product_features&id={$row['Product_Features_Id']}\">
                <button type=\"submit\" name=\"delete_category\" class=\"btn btn-danger\">Delete</button>
                </a>
                </td>
            </tr>";
            $counter++;
        }
        echo $table;
    } else {
        echo ' <tr><td colspan="3">No Record Found.</td></tr>';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['category_id'])) {
        $category_id = get_safe_value($conn, $_POST['category_id']);

        $query = "SELECT `Category_Name` FROM `category` WHERE `Category_Id`='$category_id'";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $category_name = $row['Category_Name'];
        echo "Features of " . ucfirst($category_name);
    }
}
