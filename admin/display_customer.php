<?php
require('header.php');
$sql = "SELECT `Customer_Id`,  `First_Name`, `Last_Name`, `Email`, `Gender` FROM `customer`";
$res = mysqli_query($conn, $sql);

?>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Customer</strong>
                    </div>
                    <div class="card-body">
                        <div class="text-success mb-4">
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
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $num = 1;
                                while ($row = mysqli_fetch_assoc($res)) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $num; ?></th>
                                        <td><?php echo $row['First_Name']; ?></td>
                                        <td><?php echo $row['Last_Name']; ?></td>
                                        <td><?php echo $row['Email']; ?></td>
                                        <td>
                                            <?php
                                            if ($row['Gender']) {
                                                echo "Male";
                                            } else {
                                                echo "Female";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="delete_table_row.php?table=customer&id=<?php echo $row['Customer_Id'] ?>"><button type="submit" name="delete_category" class="btn btn-danger">Delete</button>
                                            </a>
                                        </td>
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