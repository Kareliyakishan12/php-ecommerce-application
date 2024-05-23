<?php
require_once('db_connect.php');
require_once("function_inc.php");

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tech World</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>" type="text/css">
</head>

<body>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__nav__option">
    <?php
    if (isset($_SESSION['login']) && isset($_SESSION['Customer_Id'])) {
        if ($_SESSION['login'] == true && $_SESSION['Customer_Id'] != '') {
    ?>
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="wishlist.php"><img src="img/icon/heart.png" alt=""></a>
            <a href="shopping-cart.php"><img src="img/icon/cart.png" alt=""></a>

            <div class="manage-user">
                <nav class="slicknav_nav slicknav_hidden" aria-hidden="true" role="menu" style="display: none;">
                    <ul>
                        <li class="slicknav_parent">
                            <div class="manage-profile">
                                <div class="manage-profile-text">Manage Users</div>
                                <span class="slicknav_arrow">▼</span>
                            </div>
                            <ul class="mobile-dropdown" role="menu" aria-hidden="false">
                                <li><a href="manage_profile.php">Manage Profile</a></li>
                                <li><a href="change_password.php">Change Password</a></li>
                                <li><a href="order.php">Orders</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
    <?php
        }
    }
    ?>
</div>


        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-lg ">
            <div class="row">
                <div class="col-lg-2 col-md-3">
                    <div class="header__logo">
                        <a href="index.php"><img src="img/logo3.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li <?php isPageActive('index.php'); ?>><a href="./index.php">Home</a></liisPageActive>
                            <li <?php isPageActive('shop.php'); ?>><a href="shop.php">Shop</a></li>
                          
                            <li <?php isPageActive('about.php'); ?>><a href="about.php">About Us</a></li>
                            <li <?php isPageActive('contact.php'); ?>><a href="contact.php">Contacts</a></li>
                            
                            <?php
                                if (!isset($_SESSION['login']) && !isset($_SESSION['Customer_Id'])) {
                                ?>
                              <li><a href="login_page.php">Login</a></li>
                                <?php
                                }
                            ?>
                              
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <ul>
                            <li><a href="wishlist.php"><img src="img/icon/heart.png" alt=""></a></li>
                            <?php
                            if (isset($_SESSION['Customer_Id']) && $_SESSION['Customer_Id'] != null) {
                                $customer_id = $_SESSION['Customer_Id'];
                            ?>
                                <li>
                                    <a href="shopping-cart.php"><img src="img/icon/cart.png" alt=""><span><?php echo getNoProductInCart($conn, $customer_id) ?></span></a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="shopping-cart.php"><img src="img/icon/cart.png" alt=""><span>0</span></a>
                                </li>
                            <?php }
                            ?>

                            <li><a href="#"><img src="img/icon/user2.png" alt=""></a>
                                <ul class="dropdown">
                                    <?php
                                    if (isset($_SESSION['login']) && isset($_SESSION['Customer_Id'])) {
                                        if ($_SESSION['login'] == true && $_SESSION['Customer_Id'] != '') {
                                    ?>
                                            <li><a href="manage_profile.php">Manage Profile</a></li>
                                            <li><a href="change_password.php">Change Password</a></li>
                                            <li><a href="order.php">Orders</a></li>
                                            <li><a href="logout.php">Logout</a></li>
                                        <?php }
                                    } else { ?>
                                        <li><a href="login_page.php">Login</a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->