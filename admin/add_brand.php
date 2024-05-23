<?php
require('header.php');
if (isset($_POST['submit'])) {
    $brand_name = $_POST['brand_name'];

    // function for next available Brand_id
    // $nextBrandID = getNextID($conn, "Brand", "Brand_Id");
    $alreadyexist = "SELECT * FROM `brand` WHERE `Brand_Name`='$brand_name'";
    $existresult = mysqli_query($conn, $alreadyexist);
    if ($row = mysqli_fetch_assoc($existresult)) {
        $error_msg = "Brand already exist";
    } else {

        $sql = "INSERT INTO `brand` (Brand_name) VALUES ('$brand_name')";
        if (mysqli_query($conn, $sql)) {
            $sucess_msg = "New Brand added successfully!";
        } else {
            $error_msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Add Brand</strong>
                    </div>
                    <div class="card-body card-block">
                        <?php if (isset($sucess_msg)) { ?>
                            <h4 class="form-text mb-4 <?php echo "text-success" ?>">
                                <?php echo $sucess_msg;
                                unset($sucess_msg); ?>
                            </h4>
                        <?php } ?>
                        <?php if (isset($error_msg)) { ?>
                            <h4 class="form-text mb-4 <?php echo "text-danger" ?>">
                                <?php echo $error_msg;
                                unset($error_msg); ?>
                            </h4>
                        <?php } ?>
                        <form action="add_brand.php" method="post" class="form-horizontal">
                            <div class="row form-group">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Brand
                                        Name:</label></div>
                                <div class="col-12 col-md-10"><input type="text" name="brand_name" id="text-input" placeholder="Brand" class="form-control" required>
                                </div>
                                <div class="col mt-4">
                                    <button type="submit" name="submit" class="btn btn-success">Add New</button>
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