<?php
require('header.php');
require('login_require.php');

//fetch cart details
if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
    $customerId = $_SESSION['Customer_Id'];

    $sql = "SELECT `Order_Id`, `Order_Date`, `Total_Amount`, `Delivery_Status` FROM `product_order` WHERE `Customer_Id`='$customerId'";

    $result = mysqli_query($conn, $sql);
}

?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>View Orders</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <span>Orders</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart my-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive-sm">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ORDER ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Delivery Status</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $order_id = $row['Order_Id'];
                                $date = $row['Order_Date'];
                                $formatted_date = date('d/m/Y', strtotime($date));
                                $total_amount = $row['Total_Amount'];
                                $delivery_status = $row['Delivery_Status'];
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td>#<?php echo $order_id ?></td>
                                    <td><?php echo $formatted_date; ?></td>
                                    <td>₹<?php echo $total_amount; ?></td>
                                    <td><?php echo $delivery_status; ?></td>
                                    <td>
                                        <a href="order_detail.php?o_id=<?php echo $order_id; ?>">
                                            <button type="button" class="btn btn-sm btn-light">View</button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="order_invoice.php?o_id=<?php echo $order_id; ?>">
                                            <button type="button" class="btn btn-sm btn-light">Invoice</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

<?php
require('footer.php');
?>