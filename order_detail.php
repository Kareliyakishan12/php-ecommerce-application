<?php
require('header.php');
require('login_require.php');

//fetch cart details
if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
    $customerId = $_SESSION['Customer_Id'];

    if (isset($_GET['o_id']) && $_GET['o_id'] != '') {
        $order_id = $_GET['o_id'];
        $sql = "SELECT od.Product_Id, p.product_name, od.Quantity, od.Price 
        FROM order_detail od
        JOIN product p ON od.Product_Id = p.product_id
        WHERE od.Order_Id = '$order_id'";
    }

    $result = mysqli_query($conn, $sql);
}

?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>View Orders</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <a href="order.php">Orders</a>
                        <span>Order Details</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart my-5">
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
                                                <h6><?php echo $row['product_name']; ?></h6>
                                            </a>
                                            <h5>₹ <?php echo $price; ?></h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item"><?php echo $qty; ?></td>
                                    <td class="cart__price">₹ <?php echo $subTotal; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__total">
                    <h6>Order total</h6>
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
                </div>
            </div>
            </form>
        </div>
    </div>
</section>

<?php
require('footer.php');
?>