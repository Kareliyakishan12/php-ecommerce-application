<?php
require('header.php');
require('login_require.php');



if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
    $customerId = $_SESSION['Customer_Id'];

    $customerSql = "SELECT `First_Name`, `Last_Name`, `Email`, `Password`, `Mobile_No`, `Gender`, `Address`, `Postcode`, `City`, `State`  FROM `customer` WHERE `Customer_Id` = $customerId";

    $cartSql = "SELECT c.`Cart_Id`, c.`Product_Id`, c.`Quantity`, c.`Price`, p.`Product_Name`
    FROM `cart` AS c
    JOIN `product` AS p ON c.`Product_Id` = p.`Product_Id`
    WHERE c.`Customer_Id` = $customerId";
}

if (isset($_POST['place_order'])) {
    $first_name = get_safe_value($conn, $_POST['first_name']);
    $last_name = get_safe_value($conn, $_POST['last_name']);
    $address = get_safe_value($conn, $_POST['address']);
    $city = get_safe_value($conn, $_POST['city']);
    $state = get_safe_value($conn, $_POST['state']);
    $postcode = get_safe_value($conn, $_POST['postcode']);
    $mobile = get_safe_value($conn, $_POST['mobile']);
    $email = get_safe_value($conn, $_POST['email']);
    $payment_type = get_safe_value($conn, $_POST['payment_type']);

    $total = 0;
    $result = mysqli_query($conn, $cartSql);
    while ($row = mysqli_fetch_assoc($result)) {
        $price = $row['Price'];
        $qty = $row['Quantity'];
        $subTotal = $price * $qty;
        $total += $subTotal;
    }
    $subtotal = ($total * 100) / 118;
    $cgst = round(($total - $subtotal) / 2);
    $sgst = round(($total - $subtotal) / 2);

    // Now use $total, $cgst, and $sgst in your SQL query
    // Update customer information
    $sql = "UPDATE `customer` SET `First_Name`='$first_name',`Last_Name`='$last_name',`Email`='$email',`Mobile_No`='$mobile',`Address`='$address',`Postcode`='$postcode',`City`='$city',`State`='$state' WHERE `Customer_Id`='$customerId'";

    if ($payment_type === 'cod') {
        if (mysqli_query($conn, $sql)) {
            $order_id = null; // Initialize order_id variable
            $product_availability_flag = true; // Flag to track product availability

            // Loop through cart items to check product availability
            $result = mysqli_query($conn, $cartSql);
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['Product_Id'];
                $qty = $row['Quantity'];

                // Check product availability
                // $check_product_sql = "SELECT `Quantity` FROM `product` WHERE `Product_Id`='$product_id'";
                // $product_result = mysqli_query($conn, $check_product_sql);
                // $product_row = mysqli_fetch_assoc($product_result);
                // $available_qty = $product_row['Quantity'];

                // if ($qty > $available_qty) {
                //     // Product not available, set flag to false and break the loop
                //     $product_availability_flag = false;
                //     break;
                // }

                // Insert into product_order table only if all products are available
                if ($order_id === null) {
                    // Proceed with order placement
                    $order_sql = "INSERT INTO `product_order`(`Total_Amount`, `CGST`, `SGST`, `Delivery_Status`, `Customer_Id`, `Delivery_Person_Id`) VALUES ('$total','$cgst','$sgst','Pending','$customerId',0)";
                    
                    
                    if (mysqli_query($conn, $order_sql)) {
                        $order_id = mysqli_insert_id($conn); // Get the inserted order_id
                        $_SESSION['Order_Id'] = $order_id;
                    } 
                    else {
                        // Error in inserting into product_order table
                        $product_availability_flag = false;
                        break;
                    }
                }

                $price = $row['Price'];
                $order_detail_sql = "INSERT INTO `order_detail`(`Order_Id`, `Product_Id`, `Quantity`, `Price`) VALUES ('$order_id','$product_id','$qty','$price')";
                if (!mysqli_query($conn, $order_detail_sql)) {
                    // Error in inserting into order_detail table
                    $product_availability_flag = false;
                    break;
                }
    

                // Update product quantity
                $update_product_qty_sql = "UPDATE `product` SET `Quantity` = `Quantity` - $qty WHERE `Product_Id`='$product_id'";
                if (!mysqli_query($conn, $update_product_qty_sql)) {
                    // Error in updating product quantity
                    $product_availability_flag = false;
                    break;
                }
            }

            if ($product_availability_flag) {
                // All products are available, proceed with deleting cart items
                $delete_cart_sql = "DELETE FROM `cart` WHERE `Customer_Id`=$customerId";
                if (mysqli_query($conn, $delete_cart_sql)) {
                    $msg = "<div class='text-success mb-4'>Order Placed Successfully!</div>";
                } else {
                    // Error in deleting cart items
                    $msg = "<div class='text-danger mb-4'>Error in placing order. Please try again.</div>";
                }
            } else {
                // Product not available, show error message
                $msg = "<div class='text-danger mb-4'>Products are not available. Please check your cart.</div>";
            }
        } else {
            $msg = "Error: " . mysqli_error($conn);
        }
    } 
    // elseif ($payment_type === 'instamojo') {
    //     if (mysqli_query($conn, $sql)) {
    //         $product_availability_flag = true; // Flag to track product availability

    //         // Loop through cart items to check product availability
    //         $result = mysqli_query($conn, $cartSql);
    //         while ($row = mysqli_fetch_assoc($result)) {
    //             $product_id = $row['Product_Id'];
    //             $qty = $row['Quantity'];

    //             // Check product availability
    //             $check_product_sql = "SELECT `Quantity` FROM `product` WHERE `Product_Id`='$product_id'";
    //             $product_result = mysqli_query($conn, $check_product_sql);
    //             $product_row = mysqli_fetch_assoc($product_result);
    //             $available_qty = $product_row['Quantity'];

    //             if ($qty > $available_qty) {
    //                 // Product not available, set flag to false and break the loop
    //                 $product_availability_flag = false;
    //                 break;
    //             }
    //         }

    //         if ($product_availability_flag) {

    //             //phone pay code start here
    //             // Example usage:
    //             $merchantTransactionId = generateUniqueMTID();

    //             $data = [
    //                 "merchantId" => "PGTESTPAYUAT",
    //                 // MT7850590068188104
    //                 "merchantTransactionId" => $merchantTransactionId,
    //                 "merchantUserId" => "MUID123",
    //                 "amount" => $total * 100,
    //                 "redirectUrl" => "https://techworldzz.000webhostapp.com/thank_you.php",
    //                 "redirectMode" => "POST",
    //                 "callbackUrl" => "https://techworldzz.000webhostapp.com/thank_you.php",
    //                 "mobileNumber" => $mobile,
    //                 "paymentInstrument" => [
    //                     "type" => "PAY_PAGE"
    //                 ]
    //             ];

    //             $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
    //             $saltIndex = 1;
    //             $encode = json_encode($data);
    //             $encoded = base64_encode($encode);
    //             $string = $encoded . '/pg/v1/pay' . $saltKey;
    //             $sha256 = hash('sha256', $string);
    //             $finalXHeader = $sha256 . '###' . $saltIndex;

    //             $ch = curl_init();
    //             curl_setopt($ch, CURLOPT_URL, "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay");
    //             curl_setopt(
    //                 $ch,
    //                 CURLOPT_HTTPHEADER,
    //                 array(
    //                     'Content-Type:application/json',
    //                     'accept:application/json',
    //                     'X-VERIFY: ' . $finalXHeader,
    //                 )
    //             );
    //             curl_setopt($ch, CURLOPT_POST, 1);
    //             curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('request' => $encoded)));
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //             $response = curl_exec($ch);
    //             $final = json_decode($response, true);

    //             // echo "<pre>";
    //             // print_r($final);
    //             // echo "</pre>";

    //             //before redirect to payment page first create a payment database entry
    //             if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
    //                 $customerId = $_SESSION['Customer_Id'];
                    
    //                 $sql = "INSERT INTO `payment`(`Payment_Id`, `Payment_Status`, `Transaction_Id`, `Total_Amount`, `Customer_Id`, `Order_Id`) VALUES ('$merchantTransactionId','pending','',0.0,'$customerId',1)";
                    
                    
                    
    //                 $result = mysqli_query($conn, $sql);
    //                 if ($result) {
    //                     //phonepay redirect code
    //                     $url = $final['data']['instrumentResponse']['redirectInfo']['url'];
    //                     redirect($url);
    //                     exit();
    //                 } else {
    //                     echo mysqli_error($conn);
    //                 }
    //             }

    //             // phone pay code end here 





    //         } else {
    //             // Product not available, show error message
    //             $msg = "<div class='text-danger mb-4'>Products are not available. Please check your cart.</div>";
    //         }
    //     }
    // }
}


?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Check Out</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <a href="shopping-cart.php">Shopping Cart</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="checkout.php" method="post">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="checkout__title">Billing Details</h6>
                        <?php
                        if (isset($msg)) {
                            echo $msg;
                        }

                        $customer = array();
                        $result = mysqli_query($conn, $customerSql);
                        $customer = mysqli_fetch_assoc($result);
                        ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Fist Name<span>*</span></p>
                                    <input type="text" name="first_name" value="<?php echo $customer['First_Name'] ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Last Name<span>*</span></p>
                                    <input type="text" name="last_name" value="<?php echo $customer['Last_Name']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" placeholder="Street Address Apartment, suite, unite ect (optinal)" class="checkout__input__add" name="address" value="<?php echo $customer['Address']; ?>" required>
                        </div>
                        <div class="checkout__input">
                            <p>Town/City<span>*</span></p>
                            <input type="text" name="city" value="<?php echo $customer['City']; ?>" required>
                        </div>
                        <div class="checkout__input">
                            <p>Country/State<span>*</span></p>
                            <input type="text" name="state" value="<?php echo $customer['State']; ?>" required>
                        </div>
                        <div class="checkout__input">
                            <p>Postcode / ZIP<span>*</span></p>
                            <input type="text" name="postcode" value="<?php echo $customer['Postcode']; ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text" name="mobile" value="<?php echo $customer['Mobile_No']; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" name="email" value="<?php echo $customer['Email']; ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Your order</h4>
                            <div class="checkout__order__products">Product <span>Price</span></div>
                            <ul class="checkout__total__products">
                                <?php
                                if ($cartSql != '') {
                                    $result = mysqli_query($conn, $cartSql);
                                    $total = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $price = $row['Price'];
                                        $qty = $row['Quantity'];
                                        $subTotal = $price * $qty;
                                        $total = $subTotal + $total;
                                ?>
                                        <li>
                                            <?php echo  $row['Product_Name']; ?><span><?php echo $qty ?> x
                                                ₹<?php echo $price; ?></span>
                                        </li>

                                <?php
                                    }
                                } ?>
                            </ul>
                            <ul class="checkout__total__all">
                                <?php
                                $subtotal = ($total * 100) / 118;
                                $cgst = ($total - $subtotal) / 2;
                                $sgst = ($total - $subtotal) / 2;
                                ?>

                                <li>Subtotal <span>₹<?php echo round($subtotal); ?></span></li>
                                <li>CGST <span>₹<?php echo round($cgst); ?></span></li>
                                <li>SGST <span>₹<?php echo round($sgst); ?></span></li>
                                <hr>
                                <li>Total <span>₹<?php echo round($total); ?></span></li>
                            </ul>
                            <div class="form-check">
                                <input class="form-check-input" type="hidden" value="cod" name="payment_type" id="cod" >
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Only Cash On Delivery Available
                                </label>
                            </div>
                            <!--<div class="form-check">-->
                            <!--    <input class="form-check-input" value="instamojo" type="radio" name="payment_type" id="online" checked>-->
                            <!--    <label class="form-check-label" for="flexRadioDefault2">-->
                            <!--        Online Payment-->
                            <!--    </label>-->
                            <!--</div>-->
                            <button type="submit" name="place_order" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<?php
require('footer.php');
?>