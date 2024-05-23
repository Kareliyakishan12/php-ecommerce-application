<?php
require('header.php');
require('login_require.php');

//fetch cart details
if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
    $customerId = $_SESSION['Customer_Id'];
    $sql = "SELECT c.`Cart_Id`, c.`Product_Id`, c.`Quantity`, c.`Price`, p.`Product_Name`
    FROM `cart` AS c
    JOIN `product` AS p ON c.`Product_Id` = p.`Product_Id`
    WHERE c.`Customer_Id` = $customerId";
    $result = mysqli_query($conn, $sql);
}

?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <a href="shop.php">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $product_id = $row['Product_Id'];
                                $productImage = getMainImageForProduct($product_id, $conn);
                                $price = $row['Price'];
                                $qty = $row['Quantity'];
                                $subTotal = $price * $qty;
                                $total = $subTotal + $total;
                            ?>
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <a href="shop-details.php?p_id=<?php echo $product_id; ?>">
                                                <img src="img/product/<?php echo $productImage; ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="product__cart__item__text">
                                            <a href="shop-details.php?p_id=<?php echo $product_id; ?>">
                                                <h6><?php echo $row['Product_Name']; ?></h6>
                                            </a>
                                            <h5>₹ <?php echo $price; ?></h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="text" class="cart-quantity" data-productid="<?php echo $product_id; ?>" value="<?php echo $qty; ?>">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">₹ <?php echo $subTotal; ?></td>
                                    <td class="cart__close"><i class="fa fa-close remove_product" data-productid="<?php echo $product_id; ?>"></i></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="continue__btn">
                            <a href="shop.php">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <div class="col-lg-4">
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <?php
                    $subtotal = ($total * 100) / 118;
                    $cgst = ($total - $subtotal) / 2;
                    $sgst = ($total - $subtotal) / 2;
                    ?>
                    <ul>
                        <li>Subtotal <span>₹ <?php echo round($subtotal); ?></span></li>
                        <li>CGST <span>₹ <?php echo round($cgst); ?></span> </li>
                        <li>SGST <span>₹ <?php echo round($sgst); ?></span></li>
                        <hr>
                        <li>Total <span>₹ <?php echo $total; ?></span></li>
                    </ul>
                    <a href="checkout.php" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

<?php
require('footer.php');
?>