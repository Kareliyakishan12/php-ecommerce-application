<?php
require('header.php');
if (isset($_POST['submit'])) {
    $category_name = $_POST['category_name'];

    function generateRandomImageName()
    {
        return  "category_img_" . uniqid() . ".jpg";
    }

    $img_name = generateRandomImageName();
    $destination_folder = "../img/category/";

    $alreadyexist = "SELECT * FROM `category` WHERE `Category_Name`='$category_name'";
    $existresult = mysqli_query($conn, $alreadyexist);
    if ($row = mysqli_fetch_assoc($existresult)) {
        $error_msg = "Category already exist";
    } else {
        $sql = "INSERT INTO category (`category_name`, `Category_Image`) VALUES ('$category_name','$img_name')";
        if (mysqli_query($conn, $sql)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $destination_folder . $img_name);
            $sucess_msg = "New category added successfully!";
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
                        <form action="add_category.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="row form-group">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Category
                                        Name:</label></div>
                                <div class="col-12 col-md-10"><input type="text" name="category_name" id="text-input" name="text-input" placeholder="category" class="form-control" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-2"><label for="file-input" class=" form-control-label">Image</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="file-input" name="image" class="form-control-file" required></div>
                            </div>
                            <div class="row">
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