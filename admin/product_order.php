<?php
require('header.php');
// $sql = "SELECT `Order_Id`, `Order_Date`, `Total_Amount`, `Delivery_Status`, `Delivery_Person_Id` FROM `product_order` ORDER BY `Order_Id` DESC";

$sql = "SELECT 
o.`Order_Id`, 
o.`Order_Date`, 
o.`Total_Amount`, 
o.`Delivery_Status`, 
o.`Delivery_Person_Id`,
CASE 
    WHEN p.`Order_Id` IS NOT NULL THEN 'Online Payment'
    ELSE 'Cash on Delivery'
END AS Payment_Type
FROM 
`product_order` o
LEFT JOIN 
`payment` p ON o.`Order_Id` = p.`Order_Id`
ORDER BY 
o.`Order_Id` DESC;
";
$result = mysqli_query($conn, $sql);

$deliverySql = "SELECT `Delivery_Person_Id`, `Name` FROM `delivery_person`";
$delResult = mysqli_query($conn, $deliverySql);

$delivery_persons = array();
while ($row = mysqli_fetch_assoc($delResult)) {
    $delivery_persons[] = $row;
}
// print_r($delivery_persons);

?>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Orders</strong>
                    </div>
                    <div class="card-body">
                        <div class="text-success delivery_person_msg my-3">
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Delivery Status</th>
                                    <th scope="col">Payment Type</th>
                                    <th scope="col">Delivery Person</th>
                                    <th scope="col">Order Id</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $order_id = $row['Order_Id'];
                                    $date = $row['Order_Date'];
                                    $formatted_date = date('d-m-Y', strtotime($date));
                                    $total_amount = $row['Total_Amount'];
                                    $delivery_status = $row['Delivery_Status'];
                                    $payment_type = $row['Payment_Type'];
                                    $delivery_person_id = $row['Delivery_Person_Id'];
                                ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $formatted_date; ?></td>
                                        <td>₹ <?php echo $total_amount; ?></td>
                                        <td><?php echo $delivery_status; ?></td>
                                        <td><?php echo $payment_type; ?></td>
                                        <td>
                                            <select name="category" class="form-control form-control-sm delivery-select">
                                                <option>Please select</option>
                                                <?php
                                                foreach ($delivery_persons as $person) { ?>
                                                    <?php if ($delivery_person_id == $person['Delivery_Person_Id']) {  ?>
                                                        <option value="<?php echo $person['Delivery_Person_Id']; ?>" data-order-id="<?php echo $order_id; ?>" selected>
                                                            <?php echo $person['Name']; ?>
                                                        </option>
                                                    <?php } else {  ?>
                                                        <option value="<?php echo $person['Delivery_Person_Id']; ?>" data-order-id="<?php echo $order_id; ?>">
                                                            <?php echo $person['Name']; ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>#<?php echo $order_id ?></td>
                                        <td>
                                            <a href="order_detail.php?o_id=<?php echo $order_id; ?>">
                                                <button type="button" class="btn btn-sm btn-secondary">View</button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
<?php
require('footer.php');
?>