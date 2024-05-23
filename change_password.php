<?php
require('header.php');
require('login_require.php');

if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
    $customerId = $_SESSION['Customer_Id'];
}

if (isset($_POST['save'])) {
    $old_password = get_safe_value($conn, $_POST['old_password']);
    $new_password = get_safe_value($conn, $_POST['new_password']);
    $re_new_password = get_safe_value($conn, $_POST['re_new_password']);

    if ($new_password == $re_new_password) {
        $sql = "SELECT `Password` FROM `customer` WHERE `Customer_Id`=$customerId";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $query_password = $row['Password'];
        if ($query_password == $old_password) {
            $sql = "UPDATE `customer` SET `Password`='$new_password' WHERE `Customer_Id`='$customerId'";
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
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Manage Password</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <span>Change Password</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="change_password.php" method="post">
                <div class="row">
                    <div class="col-lg-12 col-md-6">
                        <?php
                        if (isset($msg)) {
                            echo $msg;
                        }
                        ?>
                        <h6 class="checkout__title">Change Password</h6>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="checkout__input">
                                    <p>Enter Old Password<span>*</span></p>
                                    <input type="password" name="old_password" required>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="checkout__input">
                                    <p>Enter New Password<span>*</span></p>
                                    <input type="password" name="new_password" required>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="checkout__input">
                                    <p>ReEnter New Password<span>*</span></p>
                                    <input type="password" name="re_new_password" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="save" class="site-btn">SAVE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<?php
require('footer.php');
?>