<?php
require('header.php');

$sql = "SELECT `Id`, `Payment_Id`, `Payment_Status`, `Transaction_Id`, `Payment_Date`, `Total_Amount`, `Order_Id` FROM `payment` ORDER BY `Order_Id` DESC";
$res = mysqli_query($conn, $sql);
?>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Stripped Table</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Payment Id</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Transaction Id</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Order Id</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $num = 1;
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $date = $row['Payment_Date'];
                                    $formatted_date = date('d-m-Y', strtotime($date));
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $num; ?></th>
                                    <td><?php echo $row['Payment_Id']; ?></td>
                                    <td><?php echo $row['Payment_Status']; ?></td>
                                    <td><?php echo $row['Transaction_Id']; ?></td>
                                    <td><?php echo $formatted_date; ?></td>
                                    <td>₹ <?php echo $row['Total_Amount']; ?></td>
                                    <td># <?php echo $row['Order_Id']; ?></td>
                                </tr>
                                <?php $num = $num + 1;
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