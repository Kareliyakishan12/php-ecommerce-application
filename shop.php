<?php
require('header.php');

if (isset($_POST['search_submit'])) {
    $searchkey = $_POST['search'];

    $searchsql = "SELECT `Product_Id`, `Product_Name`, `Price`, `Mrp`, `Quantity`, `Description`, `Brand_Id`, `Category_Id`
    FROM `product`
    WHERE `Product_Name` LIKE '%$searchkey%'";
}

?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="shop.php" method="post">
                            <input type="text" name="search" placeholder="Search...">
                            <button type="submit" name="search_submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                <?php
                                                $category_sql = "SELECT `Category_Id`, `Category_Name` FROM `category`";
                                                $result = mysqli_query($conn, $category_sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <li><a href="shop.php?c_id=<?php echo $row['Category_Id']; ?>"><?php echo $row['Category_Name']; ?></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                </div>
                                <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                <?php
                                                $category_sql = "SELECT `Brand_Id`, `Brand_Name` FROM `brand`";
                                                $result = mysqli_query($conn, $category_sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <li><a href="shop.php?b_id=<?php echo $row['Brand_Id']; ?>"><?php echo $row['Brand_Name']; ?></a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Showing 1–12 of 126 results</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sort by Price:</p>
                                <select>
                                    <option value="">Low To High</option>
                                    <option value="">$0 - $55</option>
                                    <option value="">$55 - $100</option>
                                </select>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="row">
                    <?php
                    if (isset($_GET['c_id']) && $_GET['c_id'] != '') {
                        $category_id = $_GET['c_id'];
                        $product = array();
                        $product = get_product($conn, $category_id);
                        if (!empty($product)) {
                            foreach ($product as $item) {
                                $ProductInCart = false;
                                $productId = $item['Product_Id'];
                                $productName = $item['Product_Name'];
                                $productPrice = $item['Price'];
                                if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
                                    $customerId = $_SESSION['Customer_Id'];
                                    $ProductInCart = isProductInCart($conn, $productId, $customerId);
                                }
                                $productImage = getMainImageForProduct($productId, $conn);
                    ?>
                                <a href="shop-details.php?p_id=<?php echo $productId; ?>">
                                    <div class="col-lg-4 col-md-6 col-sm-6">
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
                        }
                    } elseif (isset($_GET['b_id']) && $_GET['b_id'] != '') {
                        $brand_id = $_GET['b_id'];
                        $product = array();
                        $product = getProductByBrand($conn, $brand_id);
                        if (!empty($product)) {
                            foreach ($product as $item) {
                                $ProductInCart = false;
                                $productId = $item['Product_Id'];
                                $productName = $item['Product_Name'];
                                $productPrice = $item['Price'];
                                if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
                                    $customerId = $_SESSION['Customer_Id'];
                                    $ProductInCart = isProductInCart($conn, $productId, $customerId);
                                }
                                $productImage = getMainImageForProduct($productId, $conn);
                            ?>
                                <a href="shop-details.php?p_id=<?php echo $productId; ?>">
                                    <div class="col-lg-4 col-md-6 col-sm-6">
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
                        }
                    } elseif (isset($searchsql)) {
                         $result = mysqli_query($conn, $searchsql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $ProductInCart = false;
                                $productId = $row['Product_Id'];
                                $productName = $row['Product_Name'];
                                $productPrice = $row['Price'];
                                if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
                                    $customerId = $_SESSION['Customer_Id'];
                                    $ProductInCart = isProductInCart($conn, $productId, $customerId);
                                }
                                $productImage = getMainImageForProduct($productId, $conn);

                            ?>
                                <a href="shop-details.php?p_id=<?php echo $productId; ?>">
                                    <div class="col-lg-4 col-md-6 col-sm-6">
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
                        }
                    } else {
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
                                    <div class="col-lg-4 col-md-6 col-sm-6">
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
                        }
                    }
                    ?>
                </div>
                <!-- <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            <a class="active" href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <span>...</span>
                            <a href="#">21</a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

<?php
require('footer.php');
?>