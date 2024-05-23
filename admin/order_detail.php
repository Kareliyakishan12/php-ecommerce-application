<?php
require('header.php');

if (isset($_GET['o_id']) && $_GET['o_id'] != null) {
    $order_id = $_GET['o_id'];
    $sql = "SELECT od.Product_Id, p.product_name, od.Quantity, od.Price 
    FROM order_detail od
    JOIN product p ON od.Product_Id = p.product_id
    WHERE od.Order_Id = '$order_id'";
    $res = mysqli_query($conn, $sql);
}
?>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Order Details</strong>
                    </div>
                    <div class="card-body">
                        <div class="text-success">
                            <?php
                            if (isset($_SESSION['delete_msg'])) {
                                echo ucfirst($_SESSION['delete_msg']);
                                unset($_SESSION['delete_msg']);
                            }
                            ?>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">SubTotal</th>
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
                                    <th scope="row"><?php echo $num; ?></th>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td>₹ <?php echo $price; ?></td>
                                    <td>₹ <?php echo $subTotal; ?></td>
                                </tr>
                                <?php $num = $num + 1;
                                } ?>
                                <tr>
                                    <td colspan="4" class="text-center">Total Amount</td>
                                    <td>₹ <?php echo $total; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Customer Details</strong>
                    </div>
                    <?php
                    if (isset($order_id)) {
                        $result = mysqli_query($conn, "SELECT `Delivery_Status`, `Customer_Id`, `Delivery_Person_Id` FROM `product_order` WHERE `Order_Id` = $order_id");
                        $row = mysqli_fetch_assoc($result);
                        $customer_id = $row['Customer_Id'];
                        $delivery_status = $row['Delivery_Status'];
                        $delivery_person_id = $row['Delivery_Person_Id'];
                    }
                    if ($customer_id != null) {
                        $result = mysqli_query($conn, "SELECT `First_Name`, `Last_Name`, `Email`,  `Mobile_No`, `Address`, `Postcode`, `City`, `State` FROM `customer` WHERE `Customer_Id` = $customer_id");
                        $row = mysqli_fetch_assoc($result);
                    }
                    ?>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Customer Name</td>
                                    <td><?php echo $row['First_Name'] . " " . $row['Last_Name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $row['Email']; ?></td>
                                </tr>
                                <tr>
                                    <td>Mobile No</td>
                                    <td><?php echo $row['Address']; ?></td>
                                </tr>
                                <tr>
                                    <td>Shipping Address</td>
                                    <td><?php echo $row['Email']; ?></td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td><?php echo $row['City']; ?></td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td><?php echo $row['State']; ?></td>
                                </tr>
                                <tr>
                                    <td>Post Code</td>
                                    <td><?php echo $row['Postcode']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if ($delivery_person_id != null && $delivery_person_id > 0) { ?>
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Delivery Person Details</strong>
                    </div>
                    <?php
                        if (isset($delivery_person_id)) {
                            $result = mysqli_query($conn, "SELECT `Name`, `Email`, `License_Number`, `Availability_Status` FROM `delivery_person` WHERE `Delivery_Person_Id` = $delivery_person_id");
                            $row = mysqli_fetch_assoc($result);
                            $availability = $row['Availability_Status'];
                        }
                        ?>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Delivery Status</td>
                                    <td><?php echo $delivery_status; ?></td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td><?php echo $row['Name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $row['Email']; ?></td>
                                </tr>
                                <tr>
                                    <td>License No</td>
                                    <td><?php echo $row['License_Number']; ?></td>
                                </tr>
                                <?php if ($availability) { ?>
                                <tr>
                                    <td>Availability</td>
                                    <td><span class="badge bg-success availability text-white p-2">Available</span></td>
                                </tr>
                                <?php } else {  ?>
                                <tr>
                                    <td>Availability</td>
                                    <td><span class="badge bg-danger availability text-white p-2">Not Available</span>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
<?php
require('footer.php');
?>