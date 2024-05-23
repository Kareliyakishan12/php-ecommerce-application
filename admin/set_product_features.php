<?php
require('header.php');

if (isset($_GET['product_id']) && isset($_GET['category_id'])) {
    if ($_GET['product_id'] != '' && $_GET['category_id'] != '') {
        $product_id = get_safe_value($conn, $_GET['product_id']);
        $category_id = get_safe_value($conn, $_GET['category_id']);

        $sql = "SELECT `Product_Features_Id`, `Product_Features_Name` FROM `product_features` WHERE `Category_Id`='$category_id'";
    }
}

if (isset($_POST['submit'])) {
    $product_id = $_POST['product_id'];
    $product_features = $_POST['product_features'];
    $sql = "";

    foreach ($product_features as $product_features_id => $value) {
        $sql .= "INSERT INTO `product_has_product_features`(`Product_Id`, `Product_Features_Id`, `Features_Value`) VALUES ('$product_id','$product_features_id','$value');";
    }
    $result = mysqli_multi_query($conn, $sql);

    if ($result) {
        $_SESSION['product_added'] = "Product Added Successfully!";
        redirect("add_product.php");
    } else {
        $_SESSION['features_error'] = "Error: " . $sql . "<br>" . mysqli_error($conn);
        redirect('add_product.php');
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
                        <form action="set_product_features.php" method="post" enctype="multipart/form-data"
                            class="form-horizontal">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <?php
                            $res = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($res)) { ?>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input"
                                        class=" form-control-label"><?php echo $row['Product_Features_Name']; ?></label>
                                </div>
                                <div class="col-12 col-md-9"><input type="text"
                                        name="product_features[<?php echo $row['Product_Features_Id'] ?>]"
                                        class="form-control" required></div>
                            </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col mt-4">
                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div><!-- .animated -->
</div><!-- .content -->
<?php
require('footer.php');
?>