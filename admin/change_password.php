<?php
require('header.php');


if (isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])) {
    $Admin_Id = $_SESSION['admin_id'];
}

if (isset($_POST['submit'])) {
    $oldpass = $_POST['oldpass'];
    $new_password = $_POST['newpass1'];
    $re_new_password = $_POST['newpass2'];

    if ($new_password == $re_new_password) {
        $sql = "SELECT `Password` FROM `admin` WHERE `Admin_Id`=$Admin_Id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $query_password = $row['Password'];
        if ($query_password == $oldpass) {
            $sql = "UPDATE `admin` SET `Password`='$new_password' WHERE `Admin_Id`='$Admin_Id'";
            if (mysqli_query($conn, $sql)) {
                $msg = "<div class='text-success mb-4'>Password Updated Successfully!</div>";
            } else {
                $msg = "Error: " . mysqli_error($conn);
            }
        } else {
            $msg = "<div class='text-danger mb-4'>Old Password incorrect!</div>";
        }
    } else {
        $msg = "<div class='text-danger mb-4'>New Password and ReEnter Password doesn't match!</div>";
    }
}

?>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Change Password</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="text-danger mb-4">
                            <?php
                            if (isset($same_name_msg)) {
                                echo ucfirst($same_name_msg);
                                unset($same_name_msg);
                            }
                            if (isset($msg)) {
                                echo $msg;
                            }
                            ?>
                        </div>
                        <form action="change_password.php" method="post" class="form-horizontal">
                            <div class="row form-group">
                                <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">Old
                                        Password:</label></div>
                                <div class="col-12 col-md-10">
                                    <input type="password" name="oldpass" id="text-input" placeholder="Old Password" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">New
                                        Password:</label></div>
                                <div class="col-12 col-md-10">
                                    <input type="password" name="newpass1" id="text-input" placeholder="New Password" class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-2"><label for="text-input" class=" form-control-label">New
                                        Password:</label></div>
                                <div class="col-12 col-md-10">
                                    <input type="password" name="newpass2" id="text-input" placeholder="New Password" class="form-control">
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