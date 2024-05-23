<?php
require('header.php');
if (isset($_POST['submit'])) {
    $feature_name = $_POST['feature_name'];
    $category_id = $_POST['category'];

    // function for next available features_id
    // $nextFeaturesID = getNextID($conn, "product_features", "product_features_Id");

    $sql = "INSERT INTO `product_features`(`Product_Features_Name`, `Category_Id`) VALUES ('$feature_name','$category_id')";
    if (mysqli_query($conn, $sql)) {
        $sucess_msg = "New Product Features added successfully!";
    } else {
        $error_msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Add Product Features</strong>
                    </div>
                    <div class="card-body card-block">
                        <?php if (isset($_SESSION['delete_msg'])) { ?>
                            <h4 class="form-text mb-4 <?php echo "text-success" ?>">
                                <?php echo $_SESSION['delete_msg'];
                                unset($_SESSION['delete_msg']); ?>
                            </h4>
                        <?php } ?>
                        <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="select" class=" form-control-label">Select Product
                                        Category:</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="category" id="category_table" class="form-control category">
                                        <option>Please select</option>
                                        <?php
                                        $cat_sql = "SELECT `Category_Id`, `Category_Name` FROM `category`";
                                        $res = mysqli_query($conn, $cat_sql);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                        ?>
                                            <option value="<?php echo $row['Category_Id']; ?>">
                                                <?php echo $row['Category_Name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Features
                                        Name:</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="text-input" name="feature_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-2">
                                    <button type="submit" name="submit" class="btn btn-success">Add New</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <strong id="dynamic_category_name" class="card-title">Features</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Feature Name</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="category_features_table">
                                <!-- dynamic table add here -->
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