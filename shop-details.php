<?php
require('header.php');

if (isset($_GET['p_id'])) {
    if ($_GET['p_id'] != '') {
        $product_id = $_GET['p_id'];
        $product_array = array();
        $product_array = getProductDetails($conn, $product_id);
        $product_img = array();
        $product_img = getAllImageForProduct($product_id, $conn);
    }
}

?>

<!-- Shop Details Section Begin -->
<section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="./index.php">Home</a>
                        <a href="./shop.php">Shop</a>
                        <span><?php echo $product_array[0]['Product_Name'];  ?></span>
                    </div>
                </div>
            </div>
            <div class="row product-view">
                <div class="col-lg-2 col-md-3">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                <img src="img/shop-details/<?php echo $product_img[0]; ?>" alt="" class="img-fluid">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                <img src="img/shop-details/<?php echo $product_img[1]; ?>" alt="" class="img-fluid">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                                <img src="img/shop-details/<?php echo $product_img[2]; ?>" alt="" class="img-fluid">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
                                <img src="img/shop-details/<?php echo $product_img[3]; ?>" alt="" class=" img-fluid">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="img/shop-details/<?php echo $product_img[0]; ?>" alt="">
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="img/shop-details/<?php echo $product_img[1]; ?>" alt="">
                            </div>
                        </div>
                        <div class=" tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="img/shop-details/<?php echo $product_img[2]; ?>" alt="">
                            </div>
                        </div>
                        <div class=" tab-pane" id="tabs-4" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="img/shop-details/<?php echo $product_img[3]; ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <div class="product__details__text">
                                <?php
                                $ProductInCart = false;
                                $ProductInWishlist = false;
                                ?>
                                <h4><?php echo $product_array[0]['Product_Name'];  ?></h4>
                                <hr>
                                <h3>₹<?php echo $product_array[0]['Price']; ?>
                                    <span><?php echo $product_array[0]['Mrp']; ?></span>
                                </h3>
                                <div class="product__details__cart__option">
                                    <?php
                                    if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
                                        $customerId = $_SESSION['Customer_Id'];
                                        $ProductInCart = isProductInCart($conn, $product_id, $customerId);
                                        $ProductInWishlist = isProductInWishlist($conn, $product_id, $customerId);
                                    }

                                    ?>
                                    <?php if ($ProductInCart) { ?>
                                        <a href="#" class="cart-btn-green">✓ Added</a>
                                    <?php } else {  ?>
                                        <div class="quantity">
                                            <div id="pro-qty" class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                        <a href="#" id="add_cart_product_detail" data-price="<?php echo $product_array[0]['Price']; ?>" data-productid="<?php echo $product_id; ?>" class="cart-btn">add to
                                            cart</a>
                                    <?php } ?>
                                </div>
                                <?php if ($ProductInWishlist) {  ?>
                                    <div class="product__details__btns__option">
                                        <a href="#"><i class="fa fa-heart" style="color: red;"></i> Wishlisted</a>
                                    </div>
                                <?php } else {  ?>
                                    <div class="product__details__btns__option">
                                        <a href="#" class="add_wishlist_product" data-productid="<?php echo $product_id; ?>"><i class="fa fa-heart"></i>
                                            add to wishlist</a>
                                    </div>
                                <?php } ?>
                                <div class="product__details__last__option">
                                    <h5> <span>Safe Cash On Delivery</span></h5>
                                    <ul>
                                        <li><span>Brand: </span><?php echo $product_array[0]['Brand_Name']; ?></li>
                                        <li><span>Category: </span><?php echo $product_array[0]['Category_Name']; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product__details__content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Product
                                    Features</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Description</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                    information</a>
                            </li> -->
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Infomation</h5>
                                        <?php
                                        $productFeaturesArray = get_product_features($conn, $product_id);
                                        foreach ($productFeaturesArray as $productFeature) {
                                            $featureName = $productFeature['Product_Features_Name'];
                                            $featureValue = $productFeature['Features_Value'];

                                            echo "$featureName : $featureValue <br>";
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-6" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <div class="product__details__tab__content__item">
                                        <h5>Description</h5>
                                        <p><?php echo $product_array[0]['Description']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="tab-pane" id="tabs-7" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <p class="note">Nam tempus turpis at metus scelerisque placerat nulla
                                        deumantos
                                        solicitud felis. Pellentesque diam dolor, elementum etos lobortis des
                                        mollis
                                        ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                        pharetras loremos.</p>
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Infomation</h5>
                                        <p>A Pocket PC is a handheld computer, which features many of the same
                                            capabilities as a modern PC. These handy little devices allow
                                            individuals to retrieve and store e-mail messages, create a contact
                                            file, coordinate appointments, surf the internet, exchange text
                                            messages
                                            and more. Every product that is labeled as a Pocket PC must be
                                            accompanied with specific software to operate the unit and must
                                            feature
                                            a touchscreen and touchpad.</p>
                                        <p>As is the case with any new technology product, the cost of a Pocket
                                            PC
                                            was substantial during it’s early release. For approximately
                                            $700.00,
                                            consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                            These days, customers are finding that prices have become much more
                                            reasonable now that the newness is wearing off. For approximately
                                            $350.00, a new Pocket PC can now be purchased.</p>
                                    </div>
                                    <div class="product__details__tab__content__item">
                                        <h5>Material used</h5>
                                        <p>Polyester is deemed lower quality due to its none natural quality’s.
                                            Made
                                            from synthetic materials, not natural like wool. Polyester suits
                                            become
                                            creased easily and are known for not being breathable. Polyester
                                            suits
                                            tend to have a shine to them compared to wool and cotton suits, this
                                            can
                                            make the suit look cheap. The texture of velvet is luxurious and
                                            breathable. Velvet is a great choice for dinner party jacket and can
                                            be
                                            worn all year round.</p>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->

<!-- Related Section Begin -->
<section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Related Product</h3>
            </div>
        </div>

        <div class="row">
            <?php
            $product = array();
            $product = get_product($conn, $product_array[0]['Category_Id'], false, $product_id);
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
<!-- Related Section End -->


<?php
require('footer.php');
?>