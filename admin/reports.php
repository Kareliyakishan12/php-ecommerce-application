<?php
require('db_connect_inc.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Order Report</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        /* Set background color for the body */
    }

    h2 {
        color: #333;
    }

    form {
        margin-bottom: 20px;
        background-color: #fff;
        /* Set background color for the form */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        /* Add box shadow for a subtle effect */
        display: flex;
        justify-content: space-between;
        /* Arrange form elements side by side */
        align-items: center;
    }

    .printable-table {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="date"],
    select {
        padding: 8px;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        width: 45%;
        /* Set width for date inputs and selects */
    }

    input[type="submit"] {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        /* Add transition for hover effect */
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    h2 {
        color: #333;
        text-align: center;
    }

    form {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="date"],
    select {
        padding: 5px;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        width: 200px;
    }

    input[type="submit"] {
        padding: 8px 15px;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    input[type="button"] {
        padding: 8px 15px;
        color: #fff;
        background-color: #E52B50;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="button"]:hover {
        background-color: #AA0000;
    }

    table {
        border-collapse: collapse;
        width: 90%;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }
    </style>
    <!-- pdf script  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <h2>TechWorld Order Report</h2>
    <form method="post" action="">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>

        <label for="category">Select Category:</label>
        <select id="category" name="category">
            <option value="all">All Categories</option>
            <?php
            // Assuming you have a database connection
            $sql = "SELECT `Category_Id`, `Category_Name` FROM `category`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Category_Id']}'>{$row['Category_Name']}</option>";
            }
            ?>
        </select>

        <label for="brand">Select Brand:</label>
        <select id="brand" name="brand">
            <option value="all">All Brands</option>
            <?php
            // Assuming you have a database connection
            $sql = "SELECT `Brand_Id`, `Brand_Name` FROM `brand`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='{$row['Brand_Id']}'>{$row['Brand_Name']}</option>";
            }
            ?>
        </select>

        <input type="submit" name="submit" value="Generate Report">
        <input type="button" value="Print Report" id="printBTN">
    </form>

    <?php

    if (isset($_POST['submit'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $category = $_POST['category'];
        $brand = $_POST['brand'];

        // Assuming you have a database connection $conn
        $sql = "SELECT o.Order_Id, od.Product_Id, p.Product_Name, p.Price, od.Quantity, o.Order_Date, o.Total_Amount,
        CASE WHEN pm.Payment_Id IS NOT NULL THEN 'Online' ELSE 'Cash on Delivery' END AS Payment_Method
        FROM product_order o
        INNER JOIN order_detail od ON o.Order_Id = od.Order_Id
        INNER JOIN product p ON od.Product_Id = p.Product_Id
        LEFT JOIN payment pm ON o.Order_Id = pm.Order_Id
        WHERE o.Order_Date BETWEEN ? AND ?";
        
        $params = array($start_date, $end_date);

        if ($category !== 'all') {
            $sql .= " AND p.Category_Id = ?";
            $params[] = $category;
        }

        if ($brand !== 'all') {
            $sql .= " AND p.Brand_Id = ?";
            $params[] = $brand;
        }

        $sql .= " ORDER BY o.Order_Id ASC";

        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<div class='printable-table'>";
                echo "<h3>Filtered Orders</h3>";
                echo "<table border='1'>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Payment Method</th>
                        <th>Total Amount</th>
                    </tr>";
                while ($row = $result->fetch_assoc()) {
                    $Total_amount = $row['Price'] * $row['Quantity'];
                    $date = $row['Order_Date'];
                    $formatted_date = date('d-m-Y', strtotime($date));
                    echo "<tr>
                        <td>{$row['Order_Id']}</td>
                        <td>{$formatted_date}</td>
                        <td>{$row['Product_Name']}</td>
                        <td>₹{$row['Price']}</td>
                        <td>{$row['Quantity']}</td>
                        <td>{$row['Payment_Method']}</td>
                        <td>₹{$Total_amount}</td>
                    </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No records found.</p>";
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }


    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // printButton.addEventListener('click', function() {
        //     window.print();
        // });
        let printButton = document.querySelector('#printBTN');
        let table = document.querySelector(".printable-table");
        printButton.addEventListener('click', () => {
            html2pdf().from(table).save();
        })
    });
    </script>
</body>

</html>