<?php
require('header.php');

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $sql = "SELECT `User_Name`, `Email` FROM `admin` WHERE `Admin_Id`=$admin_id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['User_Name'];
        $email = $row['Email'];
    } else {
        $error_msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if (isset($_POST['submit'])) {
    $admin_id = $_POST['admin_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $sql = "UPDATE `admin` SET `User_Name`='$username',`Email`='$email' WHERE `Admin_Id`='$admin_id'";
    if (mysqli_query($conn, $sql)) {
        redirect("index.php");
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
                        <strong>Manage Profile</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="text-danger mb-4">
                            <?php
                            if (isset($same_name_msg)) {
                                echo ucfirst($same_name_msg);
                                unset($same_name_msg);
                            }
                            ?>
                        </div>
                        <form action="manage_profile.php" method="post" class="form-horizontal">
                            <div class="row form-group">
                                <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Username:</label></div>
                                <div class="col-12 col-md-10">
                                    <?php if (isset($username)) { ?>
                                        <input type="text" name="username" id="text-input" placeholder="username" class="form-control" value="<?php echo $username ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Email:</label></div>
                                <div class="col-12 col-md-10">
                                    <?php if (isset($email)) { ?>
                                        <input type="email" name="email" id="text-input" placeholder="Email" class="form-control" value="<?php echo $email ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row form-group">
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