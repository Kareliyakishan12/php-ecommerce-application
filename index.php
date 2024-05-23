<?php
require('header.php');

?>
<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="img/hero/hero-3.jpg">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-6 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Mobile Shop</h6>
                            <h2>Explore The World Of Electronics</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero__items set-bg" data-setbg="img/hero/hero-6.jpg">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-6 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Mobile collection</h6>
                            <h2>Mobile Marvels & Accessory Wonders</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<section class="banner spad mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Unbeatable Savings: Shop iPad Deals Now!</h2>
                        <a href="shop-details.php?p_id=3">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-8.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Rush To Get Your Ultimate Audio Partner!</h2>
                        <a href="shop-details.php?p_id=13">Shop now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <img src="img/banner/banner-7.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Effortless Control, Exceptional Design</h2>
                        <a href="shop-details.php?p_id=12">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Banner Section End -->

<!-- categories section Begin  -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="category_heading">
                    <li>Shop by category</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            <?php
            $category = array();
            $category = get_category($conn);
            if (!empty($category)) {
                foreach ($category as $item) {
                    $categoryId = $item['Category_Id'];
                    $categoryName = $item['Category_Name'];
                    $categoryImage = $item['Category_Image'];
            ?>
                    <div class="col-lg-2 col-sm-6 col-md-4 col-6 mix new-arrivals">
                        <a href="shop.php?c_id=<?php echo $categoryId; ?>">
                            <div class="category__item text-center">
                                <img src="img/category/<?php echo $categoryImage; ?>" class="img-fluid" alt="Responsive image">
                                <div class="category__item__text text-center">
                                    <h5><?php echo $categoryName; ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php }
            } ?>
        </div>
</section>

<!-- categories section End  -->


<!-- delivery section start  -->
<div class="container delivery_sec my-5">
    <div class=" row">
        <div class="col-12 col-lg-6 firstBox">
            <div class="custom_content__item item_block_text item-16631527576cdc738d-1 ">
                <div class="h5 mb-1 block-title">
                    <div class="caption-delivery">
                        <p>Convenient Pickup</p>
                    </div>
                </div>
                <div class="text-medium mb-1 block-text">
                    <div class="caption-item">
                        <p>Always free. Opt for order pickup for your items. Then, when your order is ready, switch to
                            curbside drive up in the Portera app. Begin Shopping.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 secondBox">
            <div class="custom_content__item item_block_text">
                <div class="h5 mb-1 block-title">
                    <div class="caption-item caption-delivery">
                        <p>Drive up</p>
                    </div>
                </div>
                <div class="text-medium mb-1 block-text">
                    <div class="caption-item">
                        <p><strong class="start_order">Always free.</strong> Choose order pickup for your items.
                            Then, when your order is ready, switch to curbside drive up in the Portera app. <a href="shop.php" class="start_order" title="All products">Start your
                                order.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- delivery section end  -->
<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <ul class="heading">
                    <li>Popular Products</li>
                    <div class="row headerWrapper"></div>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            <?php
            $product = array();
            if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
                $customerId = $_SESSION['Customer_Id'];
            }
            $product = get_product($conn, null);
            if (!empty($product)) {
                foreach ($product as $item) {
                    $ProductInCart = false;
                    $productId = $item['Product_Id'];
                    $productName = $item['Product_Name'];
                    $productPrice = $item['Price'];
                    if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
                        $ProductInCart = isProductInCart($conn, $productId, $customerId);
                    }
                    $productImage = getMainImageForProduct($productId, $conn);
            ?>
                    <a href="shop-details.php?p_id=<?php echo $productId; ?>">
                        <div class="col-lg-3 col-md-4 col-6 col-md-4 col-sm-6 mix new-arrivals">
                            <div class="product__item">
                                <div class="product__item__pic">
                                    <img src="img/product/<?php echo $productImage; ?>" alt="image not found">
                                </div>
                                <div class="product__item__text">
                                    <h6><?php echo $productName; ?></h6>

                                    <?php if ($ProductInCart) { ?>
                                        <a class="text-success">
                                            ✓ Added
                                        </a>
                                    <?php } else { ?>
                                        <a href="#" class="add-to-cart" data-productid="<?php echo $productId; ?>" data-price="<?php echo $productPrice; ?>">
                                            + Add To Cart
                                        </a>
                                    <?php } ?>

                                    <h5>₹<?php echo $productPrice; ?></h5>
                                </div>
                            </div>
                        </div>
                    </a>
            <?php }
            } else {
                echo "No products found.";
            } ?>
        </div>
    </div>
</section>
<!-- Product Section End -->
<!-- <div class="row product__filter">
    <div class="col-lg-3 col-md-4 col-6 col-md-4 col-sm-6 mix new-arrivals">
        <div class="product__item">
            <div class="product__item__pic">
                <img src="img/product/mobile1.jpg" alt="">
            </div>
            <div class="product__item__text">
                <a href="shop-details.php">
                    <h6>Opoo A54</h6>
                </a>
                <a href="#" class="add-cart">+ Add To Cart</a>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                </div>
                <h5>$67.24</h5>
            </div>
        </div>
    </div>
</div> -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <ul class="heading">
                    <li>New Arrival</li>
                    <div class="row headerWrapper"></div>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            <?php
            $product = array();
            $product = get_product($conn, null, true);
            if (!empty($product)) {
                foreach ($product as $item) {
                    $ProductInCart = false;
                    $productId = $item['Product_Id'];
                    $productName = $item['Product_Name'];
                    if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
                        $ProductInCart = isProductInCart($conn, $productId, $customerId);
                    }
                    $productPrice = $item['Price'];
                    $productImage = getMainImageForProduct($productId, $conn);
            ?>
                    <a href="shop-details.php?p_id=<?php echo $productId; ?>">
                        <div class="col-lg-3 col-md-4 col-6 col-md-4 col-sm-6 mix new-arrivals">
                            <div class="product__item">
                                <div class="product__item__pic">
                                    <img src="img/product/<?php echo $productImage; ?>" alt="image not found">
                                </div>
                                <div class="product__item__text">
                                    <h6><?php echo $productName; ?></h6>

                                    <?php if ($ProductInCart) { ?>
                                        <a class="text-success">
                                            ✓ Added
                                        </a>
                                    <?php } else { ?>
                                        <a href="#" class="add-to-cart" data-productid="<?php echo $productId; ?>" data-price="<?php echo $productPrice; ?>">
                                            + Add To Cart
                                        </a>
                                    <?php } ?>

                                    <h5>₹<?php echo $productPrice; ?></h5>
                                </div>
                            </div>
                        </div>
                    </a>
            <?php }
            } else {
                echo "No products found.";
            } ?>
        </div>
    </div>
</section>
<!-- Product Section End -->

<?php
require('footer.php');
?>