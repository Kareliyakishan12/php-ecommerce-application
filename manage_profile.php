<?php
require('header.php');
require('login_require.php');


if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
    $customerId = $_SESSION['Customer_Id'];

    $customerSql = "SELECT `First_Name`, `Last_Name`, `Email`, `Password`, `Mobile_No`, `Gender`, `Address`, `Postcode`, `City`, `State`  FROM `customer` WHERE `Customer_Id` = $customerId";
}

if (isset($_POST['save'])) {
    $first_name = get_safe_value($conn, $_POST['first_name']);
    $last_name = get_safe_value($conn, $_POST['last_name']);
    $address = get_safe_value($conn, $_POST['address']);
    $city = get_safe_value($conn, $_POST['city']);
    $state = get_safe_value($conn, $_POST['state']);
    $postcode = get_safe_value($conn, $_POST['postcode']);
    $mobile = get_safe_value($conn, $_POST['mobile']);
    $email = get_safe_value($conn, $_POST['email']);

    $sql = "UPDATE `customer` SET `First_Name`='$first_name',`Last_Name`='$last_name',`Email`='$email',`Mobile_No`='$mobile',`Address`='$address',`Postcode`='$postcode',`City`='$city',`State`='$state' WHERE `Customer_Id`='$customerId'";

    if (mysqli_query($conn, $sql)) {
        $msg = "<div class='text-success mb-4'>Profile Updated Successfully!</div>";
    } else {
        $msg = "Error: " . mysqli_error($conn);
    }
}


?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Manage Profile</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <span>Manage Profile</span>
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
            <form action="manage_profile.php" method="post">
                <div class="row">
                    <div class="col-lg-12 col-md-6">
                        <?php
                        if (isset($msg)) {
                            echo $msg;
                        }
                        ?>
                        <h6 class="checkout__title">Manage Profile</h6>
                        <?php
                        $customer = array();
                        $result = mysqli_query($conn, $customerSql);
                        $customer = mysqli_fetch_assoc($result);
                        ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Fist Name<span>*</span></p>
                                    <input type="text" name="first_name" value="<?php echo $customer['First_Name'] ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Last Name<span>*</span></p>
                                    <input type="text" name="last_name" value="<?php echo $customer['Last_Name']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" placeholder="Street Address Apartment, suite, unite ect (optinal)" class="checkout__input__add" name="address" value="<?php echo $customer['Address']; ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="checkout__input">
                                    <p>Town/City<span>*</span></p>
                                    <input type="text" name="city" value="<?php echo $customer['City']; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="checkout__input">
                                    <p>Country/State<span>*</span></p>
                                    <input type="text" name="state" value="<?php echo $customer['State']; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="checkout__input">
                                    <p>Postcode / ZIP<span>*</span></p>
                                    <input type="text" name="postcode" value="<?php echo $customer['Postcode']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input type="text" name="mobile" value="<?php echo $customer['Mobile_No']; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" name="email" value="<?php echo $customer['Email']; ?>" required>
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