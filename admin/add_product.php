<?php
require('header.php');

if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $mrp = $_POST['mrp'];
    $qty = $_POST['qty'];
    $description = $_POST['description'];
    $description = get_safe_value($conn, $description);

    function generateRandomImageName($no)
    {
        return $no . "_img_" . uniqid() . ".jpg";
    }

    $img1_name = generateRandomImageName(1);
    $img2_name = generateRandomImageName(2);
    $img3_name = generateRandomImageName(3);
    $img4_name = generateRandomImageName(4);

    $destination_folder_main = "../img/shop-details/";
    $destination_folder_secondary = "../img/product/";

    $sql = "INSERT INTO `product`(`Product_Name`, `Price`,`Mrp` , `Quantity`, `Description`, `Brand_Id`, `Category_Id`) VALUES ('$product_name','$price','$mrp','$qty','$description','$brand','$category')";

    $image_sql = "";

    if (mysqli_query($conn, $sql)) {
        $inserted_product_id = mysqli_insert_id($conn);

        for ($i = 1; $i <= 4; $i++) {
            $image_name = ${"img" . $i . "_name"}; //with this $img(dynamic)_name will be generated
            $image_sql .= "INSERT INTO `product_image`(`Product_Image_Path`, `Product_Id`) VALUES ('$image_name','$inserted_product_id');";
        }

        if (mysqli_multi_query($conn, $image_sql)) {
            // Move uploaded images to the appropriate directories
            copy($_FILES['image1']['tmp_name'], $destination_folder_secondary . $img1_name); //main image folder
            move_uploaded_file($_FILES['image1']['tmp_name'], $destination_folder_main . $img1_name); //same image in product detail folder 
            move_uploaded_file($_FILES['image2']['tmp_name'], $destination_folder_main . $img2_name);
            move_uploaded_file($_FILES['image3']['tmp_name'], $destination_folder_main . $img3_name);
            move_uploaded_file($_FILES['image4']['tmp_name'], $destination_folder_main . $img4_name);

            redirectWithParams('https://techworldzz.000webhostapp.com/admin/set_product_features.php', array('product_id' => $inserted_product_id, 'category_id' => $category)); //redirect to set product features where all product features form will generate
        } else {
            $error_msg = "Error: " . $image_sql . "<br>" . mysqli_error($conn);
        }
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
                        <strong>Add Product</strong>
                    </div>
                    <div class="card-body card-block">
                        <?php if (isset($_SESSION['product_added'])) { ?>
                            <h4 class="form-text mb-4 <?php echo "text-success" ?>">
                                <?php echo $_SESSION['product_added'];
                                unset($_SESSION['product_added']); ?>
                            </h4>
                        <?php } ?>
                        <?php if (isset($_SESSION['features_error'])) { ?>
                            <h4 class="form-text mb-4 <?php echo "text-danger" ?>">
                                <?php echo $_SESSION['features_error'];
                                unset($_SESSION['features_error']); ?>
                            </h4>
                        <?php } ?>
                        <?php if (isset($error_msg)) { ?>
                            <h4 class="form-text mb-4 <?php echo "text-danger" ?>">
                                <?php echo $error_msg;
                                unset($error_msg); ?>
                            </h4>
                        <?php } ?>
                        <form action="add_product.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product
                                        Name:</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="product_name" placeholder="Product" class="form-control"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="select" class=" form-control-label">Select Product
                                        Category:</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="category" id="category" class="form-control">
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
                                <div class="col col-md-3"><label for="select" class=" form-control-label">Select Product
                                        Brand:</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="brand" id="select" class="form-control">
                                        <option>Please select</option>
                                        <?php
                                        $cat_sql = "SELECT `Brand_Id`, `Brand_Name` FROM `brand`";
                                        $res = mysqli_query($conn, $cat_sql);
                                        while ($row = mysqli_fetch_assoc($res)) {
                                        ?>
                                            <option value="<?php echo $row['Brand_Id']; ?>">
                                                <?php echo $row['Brand_Name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Price:</label></div>
                                <div class="col-md-2 col-12">
                                    <input type="number" id="typeNumber" name="price" class="form-control" />
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Mrp:</label></div>
                                <div class="col-md-2 col-12">
                                    <input type="number" id="typeNumber" name="mrp" class="form-control" />
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Qty:</label></div>
                                <div class="col-md-2 col-12">
                                    <input type="number" name="qty" id="typeNumber" class="form-control" />
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Description</label></div>
                                <div class="col-12 col-md-9"><textarea name="description" id="textarea-input" rows="9" placeholder="Desc..." class="form-control"></textarea></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">Image:1(Main)</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="file-input" name="image1" class="form-control-file" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">Image:2</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="file-input" name="image2" class="form-control-file" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">Image:3</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="file-input" name="image3" class="form-control-file" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">Image:4</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="file-input" name="image4" class="form-control-file" required></div>
                            </div>
                            <div class="row">
                                <div class="col mt-4">
                                    <button type="submit" name="submit" class="btn btn-success">Next</button>
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