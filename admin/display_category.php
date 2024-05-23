<?php
require('header.php');
$sql = "SELECT `Category_Id`, `Category_Name` FROM `category`";
$res = mysqli_query($conn, $sql);

?>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Categories</strong>
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
                                    <th scope="col">Category Name</th>
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
                                        <td><?php echo $row['Category_Name']; ?></td>
                                        <td colspan="2">
                                            <a href="update_category.php?id=<?php echo $row['Category_Id'] ?>">
                                                <button type="button" class="btn btn-primary mx-1">
                                                    Update
                                                </button>
                                            </a>
                                            <a href="delete_table_row.php?table=category&id=<?php echo $row['Category_Id'] ?>"><button type="submit" name="delete_category" class="btn btn-danger">Delete</button>
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