<?php
require('header.php');
require('db_connect.php');

// phonepay give some data in get method and if payment is succesfull then insert data into order and order details
if (isset($_POST) && $_POST != null) {
    $response = $_POST;

    // echo '<pre>';
    // print_r($response);
    // echo '</pre>';

    $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
    $saltIndex = 1;

    $string = '/pg/v1/status/' . $response['merchantId'] . '/' . $response['transactionId'] . $saltKey;
    $sha256 = hash('sha256', $string);
    $finalXHeader = $sha256 . '###' . $saltIndex;


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/" . $response['merchantId'] . "/" . $response['transactionId']);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type:application/json',
            'accept:application/json',
            'X-VERIFY: ' . $finalXHeader,
            'X-MERCHANT-ID:' . $response['merchantId']
        )
    );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $final = json_decode($response, true);

    if ($final['data']['merchantTransactionId'] != null) {
        $order_id = null;

        $merchantId = $final['data']['merchantTransactionId'];
        $sql = "SELECT `Customer_Id` FROM `payment` WHERE `Payment_Id`='$merchantId'";
        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['login'] = true;
            $_SESSION['Customer_Id'] = $row['Customer_Id'];
            $customerId = $_SESSION['Customer_Id'];
        }

        if ($final['success'] == 1 && $final['code'] == 'PAYMENT_SUCCESS') {
            if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
                $cartSql = "SELECT c.`Cart_Id`, c.`Product_Id`, c.`Quantity`, c.`Price`, p.`Product_Name`
                                FROM `cart` AS c
                                JOIN `product` AS p ON c.`Product_Id` = p.`Product_Id`
                                WHERE c.`Customer_Id` = $customerId";
                $result = mysqli_query($conn, $cartSql);
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC); // Fetch all rows into an array
                mysqli_free_result($result); // Free the result set
            }

            $total = 0;
            foreach ($rows as $row) {
                $price = $row['Price'];
                $qty = $row['Quantity'];
                $subTotal = $price * $qty;
                $total += $subTotal;
            }
            $subtotal = ($total * 100) / 118;
            $cgst = round(($total - $subtotal) / 2);
            $sgst = round(($total - $subtotal) / 2);

            $error = false;
            $order_sql = "INSERT INTO `product_order`(`Total_Amount`, `CGST`, `SGST`, `Delivery_Status`, `Customer_Id`) VALUES ('$total','$cgst','$sgst','Pending','$customerId')";

            if (mysqli_query($conn, $order_sql)) {
                $order_id = mysqli_insert_id($conn); // Get the inserted order_id
                foreach ($rows as $row) {
                    $product_id = $row['Product_Id'];
                    $price = $row['Price'];
                    $qty = $row['Quantity'];
                    $order_detail_sql = "INSERT INTO `order_detail`(`Order_Id`, `Product_Id`, `Quantity`, `Price`) VALUES ('$order_id','$product_id','$qty','$price')";
                    if (!mysqli_query($conn, $order_detail_sql)) {
                        // Error in inserting into order_detail table
                        $error = true;
                        break;
                    }
                }
            } else {
                // Error in inserting into product_order table
                $error = true;
            }

            if ($error == true) {
                $msg = "<div class='text-danger mb-4'>Error in insertion in order or order detail table.</div>";
            } else {
                if (isset($final['data']['transactionId']) && $final['data']['transactionId'] != null) {
                    $transaction_id = $final['data']['transactionId'];

                    $result_payment = mysqli_query($conn, "UPDATE `payment` SET `Payment_Status`='Successfull',`Transaction_Id`='$transaction_id',`Total_Amount`='$total',`Order_Id`='$order_id' WHERE `Payment_Id`='$merchantId'");
                }
                if ($result_payment) {
                    $delete_cart_sql = "DELETE FROM `cart` WHERE `Customer_Id`=$customerId";
                    if (mysqli_query($conn, $delete_cart_sql)) {
                        $msg = "Order Placed Successfully!";
                    } else {
                        // Error in deleting cart items
                        $msg = "<div class='text-danger mb-4'>Error in placing order. Please try again.</div>";
                    }
                }
            }
        } else {
            $msg = "<div class='text-danger mb-4'>Order is not placed Your Payment is Failed.</div>";
        }
    }
}
?>
<?php
if (isset($msg)) {
    echo '<div style="height:60vh;">
        <div class="success-animation">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>
        </div>
        <div class="text-center text-success h4">Your Order Has Been placed succefully!</div>
    </div>';
} else {
    echo '<div style="height:60vh;">
        <div class="text-center text-danger h4">Payment Failed!!</div>
    </div>';
}
?>

<?php
require('footer.php');
?>