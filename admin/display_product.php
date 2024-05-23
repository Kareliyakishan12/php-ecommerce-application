<?php
require('header.php');
$sql = "SELECT 
p.Product_Id,
p.Product_Name,
p.Price,
p.Quantity,
b.Brand_Name,
c.Category_Name
FROM 
product p
JOIN 
brand b ON p.Brand_Id = b.Brand_Id
JOIN 
category c ON p.Category_Id = c.Category_Id
";
$res = mysqli_query($conn, $sql);
?>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Products</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Qty</th>
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
                                    <td><?php echo $row['Product_Name']; ?></td>
                                    <td><?php echo $row['Category_Name']; ?></td>
                                    <td><?php echo $row['Brand_Name']; ?></td>
                                    <td><?php echo $row['Price']; ?></td>
                                    <td><?php echo $row['Quantity']; ?></td>
                                    <td colspan="2">
                                        <!-- <a href="#">
                                            <button type="button" class="btn btn-primary mx-1">
                                                Update
                                            </button>
                                        </a> -->
                                        <a
                                            href="delete_table_row.php?table=product&id=<?php echo $row['Product_Id'] ?>"><button
                                                type="submit" name="delete_category"
                                                class="btn btn-danger">Delete</button>
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