<?php
require('header.php');
function getDashboardInfo($conn, $infoType)
{
    $infoValue = null;

    switch ($infoType) {
        case 'numDeliveryPersons':
            $sql = "SELECT COUNT(*) AS numDeliveryPersons FROM delivery_person";
            break;
        case 'numCustomers':
            $sql = "SELECT COUNT(*) AS numCustomers FROM customer";
            break;
        case 'numContacts':
            $sql = "SELECT COUNT(*) AS numContacts FROM contacts";
            break;
        case 'numOrders':
            $sql = "SELECT COUNT(*) AS numOrders FROM product_order";
            break;
        case 'numProducts':
            $sql = "SELECT COUNT(*) AS numProducts FROM product";
            break;
        case 'numBrands':
            $sql = "SELECT COUNT(*) AS numBrands FROM brand";
            break;
        case 'numCategories':
            $sql = "SELECT COUNT(*) AS numCategories FROM category";
            break;
        case 'totalRevenue':
            $sql = "SELECT SUM(Total_Amount) AS totalRevenue FROM product_order";
            break;
        default:
            return null; // Invalid infoType, return null
    }

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Debugging output
    // echo "SQL Query: $sql<br>";
    // echo "Fetched Row: ";
    // print_r($row);

    if ($row) {
        $infoValue = $row[$infoType];
    }

    return $infoValue;
}

?>
<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <?php
        $numDeliveryPersons = getDashboardInfo($conn, 'numDeliveryPersons');
        $numCustomers = getDashboardInfo($conn, 'numCustomers');
        $numOrders = getDashboardInfo($conn, 'numOrders');
        $numProducts = getDashboardInfo($conn, 'numProducts');
        $numBrands = getDashboardInfo($conn, 'numBrands');
        $numCategories = getDashboardInfo($conn, 'numCategories');
        $totalRevenue = getDashboardInfo($conn, 'totalRevenue');
        $numContacts = getDashboardInfo($conn, 'numContacts');
        ?>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="pe-7s-cash"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo  $totalRevenue ?></span></div>
                                    <div class="stat-heading">Revenue</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-cart"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo $numOrders;  ?></span>
                                    </div>
                                    <div class="stat-heading">Orders</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-3">
                                <i class="pe-7s-users"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo $numCustomers; ?></span></div>
                                    <div class="stat-heading">Customers</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <!-- <i class="fa fa-truck"></i> -->
                                <i class="pe-7s-car"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo $numDeliveryPersons ?></span>
                                    </div>
                                    <div class="stat-heading">Delivery Persons</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-3">
                                <!-- <i class="fa fa-shopping-bag"></i> -->
                                <i class="pe-7s-shopbag"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo $numProducts ?></span>
                                    </div>
                                    <div class="stat-heading">Products</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <!-- <i class="fa fa-tags"></i> -->
                                <i class="pe-7s-ticket"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo $numBrands ?></span>
                                    </div>
                                    <div class="stat-heading">Brands</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <!-- <i class="pe-7s-users"></i> -->
                                <i class="pe-7s-folder"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo $numCategories ?></span>
                                    </div>
                                    <div class="stat-heading">Categories</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <!-- <i class="pe-7s-users"></i> -->
                                <i class="pe-7s-add-user"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count"><?php echo $numContacts ?></span>
                                    </div>
                                    <div class="stat-heading">Contacts</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="orders">
            <?php
            $sql = "SELECT 
            po.Order_Id, 
            po.Order_Date, 
            po.Total_Amount, 
            po.Delivery_Status, 
            po.Delivery_Person_Id,
            c.First_Name, 
            c.Last_Name 
        FROM 
            product_order po 
        JOIN 
            customer c ON po.Customer_Id = c.Customer_Id
        ORDER BY 
            po.Order_Id DESC 
        LIMIT 6";
            $result = mysqli_query($conn, $sql);
            ?>
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title">Orders </h4>
                        </div>
                        <div class="card-body--">
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th class="text-center">Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $order_id = $row['Order_Id'];
                                            $customerName = $row['First_Name'] . ' ' . $row['Last_Name'];
                                            $date = $row['Order_Date'];
                                            $formatted_date = date('d-m-Y', strtotime($date));
                                            $total_amount = $row['Total_Amount'];
                                            $delivery_status = $row['Delivery_Status'];
                                            $delivery_person_id = $row['Delivery_Person_Id'];
                                        ?>
                                        <tr>
                                            <td class="serial"><?php echo $no; ?></td>
                                            <td> #<?php echo $order_id; ?></td>
                                            <td> <span class="name"><?php echo $customerName; ?></span> </td>
                                            <td> <span class="product"><?php echo $formatted_date;  ?></span> </td>
                                            <td>₹ <span class="count"><?php echo $total_amount; ?></span></td>
                                            <td class="text-center">
                                                <?php if ($delivery_status == "Pending") {  ?>
                                                <span class="badge bg-secondary"><?php echo $delivery_status; ?></span>
                                                <?php } ?>
                                                <?php if ($delivery_status == "Shipped") {  ?>
                                                <span class="badge bg-warning"><?php echo $delivery_status; ?></span>
                                                <?php } ?>
                                                <?php if ($delivery_status == "Out for Delivery") {  ?>
                                                <span class="badge bg-info"><?php echo $delivery_status; ?></span>
                                                <?php } ?>
                                                <?php if ($delivery_status == "Delivered") {  ?>
                                                <span class="badge bg-success"><?php echo $delivery_status; ?></span>
                                                <?php } ?>

                                            </td>
                                            <td>
                                                <a href="order_detail.php?o_id=<?php echo $order_id; ?>">
                                                    <button type="button"
                                                        class="btn btn-sm bg-flat-color-3 text-white">View</button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $no++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->
                        </div>
                    </div> <!-- /.card -->
                </div> <!-- /.col-lg-8 -->

                <div class="col-xl-4">
                    <div class="row">
                        <div class="col-lg-6 col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h4 class="box-title">Chandler</h4> -->
                                    <div class="calender-cont widget-calender">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div><!-- /.card -->
                        </div>
                        <div class="col-lg-6 col-xl-12">
                            <div class="card bg-flat-color-3  ">
                                <div class="card-body">
                                    <h4 class="card-title m-0  white-color ">
                                        <?php echo date('F Y'); ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.col-md-4 -->
            </div>

        </div>
        <!-- /Widgets -->
    </div>
    <!-- .animated -->
</div>
<!-- /.content -->
<?php
require('footer.php');
?>