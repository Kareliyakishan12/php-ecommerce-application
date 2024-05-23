<?php
require('header.php');
if (isset($_GET['id']) && $_GET['id'] != '') {
    $category_id = get_safe_value($conn, $_GET['id']);
    $sql = "SELECT `Category_Name` FROM `category` WHERE `Category_Id`='$category_id'";
    $result = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($result);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($result);
        $category_name = $row['Category_Name'];
    } else {
        redirect("display_category.php");
        die();
    }
}

if (isset($_POST['submit'])) {
    $new_category_name = $_POST['category_name'];
    $category_id = $_POST['category_id'];
    $sql = "select * from category where Category_Name ='$new_category_name'";
    $res = mysqli_query($conn, $sql);
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $same_name_msg = "Category already exist";
    } else {
        $sql = "UPDATE `category` SET `Category_Name`='$new_category_name' WHERE `Category_Id`='$category_id'";
        if (mysqli_query($conn, $sql)) {
            redirect("display_category.php");
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
                        <strong>Add Category</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="update_category.php" method="post" class="form-horizontal">
                            <div class="row form-group">
                                <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Category
                                        Name:</label></div>
                                <div class="col-12 col-md-10">
                                    <?php if (isset($category_name)) { ?>
                                        <input type="text" name="category_name" id="text-input" name="text-input" placeholder="category" class="form-control" value="<?php echo $category_name ?>">
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