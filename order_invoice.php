<?php
require('db_connect.php');
if (isset($_GET['o_id']) && $_GET['o_id'] != null) {
    $order_id = $_GET['o_id'];
    $sql = "SELECT od.Product_Id, p.product_name, od.Quantity, od.Price 
        FROM order_detail od
        JOIN product p ON od.Product_Id = p.product_id
        WHERE od.Order_Id = '$order_id'";
    $res = mysqli_query($conn, $sql);

    if (isset($_SESSION['Customer_Id']) && $_SESSION['login'] == true || empty($_SESSION['Customer_Id'])) {
        $customerId = $_SESSION['Customer_Id'];
        $CustomerSql = "SELECT  `First_Name`, `Last_Name`, `Email`, `Password`, `Mobile_No`, `Gender`, `Address`, `Postcode`, `City`, `State` FROM `customer` WHERE `Customer_Id`='$customerId'";
    }

    $paymentSql = "SELECT `Transaction_Id` FROM `payment` WHERE  `Order_Id`= '$order_id'";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
    body {
        background-color: #F6F6F6;
        margin: 0;
        padding: 0;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin: 0;
        padding: 0;
    }

    p {
        margin: 0;
        padding: 0;
    }

    .container {
        margin-top: 30px;
        width: 80%;
        margin-right: auto;
        margin-left: auto;
    }

    .brand-section {
        padding: 10px 40px;
        border: 1px solid gray;
    }

    .logo {
        width: 50%;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .col-6 {
        width: 50%;
        flex: 0 0 auto;
    }

    .text-white {
        color: #fff;
    }

    .company-details {
        float: right;
        text-align: right;
    }

    .body-section {
        padding: 16px;
        border: 1px solid gray;
    }

    .heading {
        font-size: 20px;
        margin-bottom: 08px;
    }

    .sub-heading {
        color: #262626;
        margin-bottom: 05px;
    }

    table {
        background-color: #fff;
        width: 100%;
        border-collapse: collapse;
    }

    table thead tr {
        border: 1px solid #111;
        background-color: #f2f2f2;
    }

    table td {
        vertical-align: middle !important;
        text-align: center;
    }

    table th,
    table td {
        padding-top: 08px;
        padding-bottom: 08px;
    }

    .table-bordered {
        box-shadow: 0px 0px 5px 0.5px gray;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6;
    }

    .text-right {
        text-align: end;
    }

    .w-20 {
        width: 20%;
    }

    .float-right {
        float: right;
    }
    </style>
</head>

<body>

    <div class="container" id="OrderInvoice">
        <div class="brand-section">
            <div class="row">
                <div class="col-6">
                    <h1 class="text">TechWorld</h1>
                </div>
                <div class="col-6">
                    <div class="company-details">
                        <p class="text">Nagnath Gajerapara Amreli, Gujarat</p>
                        <p class="text">Email- Techworld07@gmail.com</p>
                        <p class="text">+91 7621060454</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="body-section">
            <div class="row">
                <div class="col-6">
                    <?php
                    $transactionId = null;
                    $paymentResult = mysqli_query($conn, $paymentSql);
                    if ($paymentResult && mysqli_num_rows($paymentResult) > 0) {
                        while ($row = mysqli_fetch_assoc($paymentResult)) {
                            $paymentMode = 'Online';
                            $transactionId = $row['Transaction_Id'];
                        }
                    } else {
                        $paymentMode = 'Cash On Delivery';
                    }

                    $customerResult = mysqli_query($conn, $CustomerSql);
                    while ($row = mysqli_fetch_assoc($customerResult)) {
                        $fullname = $row['First_Name'] . ' ' . $row['Last_Name'];
                        $customerEmail = $row['Email'];
                        $address = $row['Address'];
                        $postcode = $row['Postcode'];
                        $mobile = $row['Mobile_No'];
                        $city = $row['City'];
                        $state = $row['State'];
                    }
                    ?>
                    <h2 class="heading">Order Id.: <?php if (isset($_GET['o_id'])) {
                                                        echo $_GET['o_id'];
                                                    } ?></h2>
                    <p class="sub-heading">Transaction Id. <?php if ($transactionId != null) {
                                                                echo $transactionId;
                                                            } ?></p>
                    <p class="sub-heading">Order Date: 26-03-2024 </p>
                    <p class="sub-heading">Email Address: <?php echo $customerEmail; ?></p>
                </div>
                <div class="col-6">
                    <p class="sub-heading"><?php echo $fullname; ?></p>
                    <p class="sub-heading">Address: <?php echo $address; ?></p>
                    <p class="sub-heading">Phone Number: <?php echo $mobile; ?></p>
                    <p class="sub-heading">City,State,Pincode: <?php echo $city . ',' . $state . ',' . $postcode ?></p>
                </div>
            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Ordered Items</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="w-20">Price</th>
                        <th class="w-20">Quantity</th>
                        <th class="w-20">Grandtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $num = 1;
                    $total = 0;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $product_id = $row['Product_Id'];
                        $price = $row['Price'];
                        $qty = $row['Quantity'];
                        $subTotal = $price * $qty;
                        $total = $subTotal + $total;
                    ?>
                    <tr>
                        <td><?php echo $row['product_name']; ?></td>
                        <td>₹<?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td>₹<?php echo $subTotal; ?></td>
                    </tr>
                    <?php $num = $num + 1;
                    } ?>
                    <?php
                    $subtotal = ($total * 100) / 118;
                    $cgst = ($total - $subtotal) / 2;
                    $sgst = ($total - $subtotal) / 2;
                    ?>
                    <tr>
                        <td colspan="3" class="text-right">Sub Total</td>
                        <td> ₹<?php echo round($subtotal); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">CGST</td>
                        <td> ₹<?php echo round($cgst); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">SGST</td>
                        <td> ₹<?php echo round($sgst); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Grand Total</td>
                        <td> ₹<?php echo round($total); ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <h3 class="heading">Payment Mode: <?php echo $paymentMode; ?></h3>
        </div>

        <div class="body-section">
            <p>&copy; Copyright 2024 - TechWorld. All rights reserved.
            </p>
        </div>
    </div>
    <script>
    window.onload = function() {
        window.print();
    }
    </script>
</body>

</html>