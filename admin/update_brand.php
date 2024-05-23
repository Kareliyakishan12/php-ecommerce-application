<?php
require('header.php');
if (isset($_GET['id']) && $_GET['id'] != '') {
    $brand_id = get_safe_value($conn, $_GET['id']);
    $sql = "SELECT `Brand_Name` FROM `brand` WHERE `brand_Id`='$brand_id'";
    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($result);
        $brand_name = $row['Brand_Name'];
    } else {
        redirect("display_brand.php");
        die();
    }
}

if (isset($_POST['submit'])) {
    $new_brand_name = $_POST['brand_name'];
    $brand_id = $_POST['brand_id'];
    $sql = "select * from brand where brand_name ='$new_brand_name'";
    $res = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $same_name_msg = "Brand already exist";
    } else {
        $sql = "UPDATE `brand` SET `brand_Name`='$new_brand_name' WHERE `brand_Id`='$brand_id'";
        if (mysqli_query($conn, $sql)) {
            redirect("display_brand.php");
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
                        <strong>Update Brand</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="update_brand.php" method="post" class="form-horizontal">
                            <div class="row form-group">
                                <input type="hidden" name="brand_id" value="<?php echo $brand_id; ?>">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">brand
                                        Name:</label></div>
                                <div class="col-12 col-md-10">
                                    <?php if (isset($brand_name)) { ?>
                                        <input type="text" name="brand_name" id="text-input" name="text-input" placeholder="brand" class="form-control" value="<?php echo $brand_name ?>">
                                    <?php } ?>
                                    <?php if (isset($error_msg)) { ?>
                                        <small class="form-text <?php echo "text-danger" ?>">
                                            <?php echo $error_msg;
                                            unset($error_msg); ?>
                                        </small>
                                    <?php } ?>
                                    <?php if (isset($same_name_msg)) { ?>
                                        <small class="form-text <?php echo "text-danger" ?>">
                                            <?php echo $same_name_msg;
                                            unset($same_name_msg); ?>
                                        </small>
                                    <?php } ?>
                                </div>
                                <div class="col my-3">
                                    <button type="submit" name="submit" class="btn btn-success">Update</button>
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