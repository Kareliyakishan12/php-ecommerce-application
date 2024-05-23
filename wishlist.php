<?php
require('header.php');
require('login_require.php');

//fetch cart details
if (isset($_SESSION['Customer_Id']) && !empty($_SESSION['Customer_Id'])) {
    $customerId = $_SESSION['Customer_Id'];

    $sql = "SELECT w.Wishlist_Id, p.Product_Id, p.Product_Name, p.Quantity, p.Price, w.Customer_Id
    FROM wishlist w
    JOIN product p ON w.Product_Id = p.Product_Id
    WHERE w.Customer_Id = '$customerId'";

    $result = mysqli_query($conn, $sql);
}

?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Manage Wishlist</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Home</a>
                        <a href="shop.php">Shop</a>
                        <span>Wishlist</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart my-5">
    <div class="d-flex justify-content-center">
        <div class="row">
            <div class="col-lg-12">
                <div class="shopping__cart__table shopping__wishlist__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Availability</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $product_id = $row['Product_Id'];
                                $productImage = getMainImageForProduct($product_id, $conn);
                                $qty = $row['Quantity'];
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
                                            <h5>₹ <?php echo $row['Price']; ?></h5>
                                        </div>
                                    </td>
                                    <?php
                                    if ($qty > 0) {
                                    ?>
                                        <td class="quantity__item">
                                            <span class="badge bg-success availability">Available</span>
                                        </td>
                                    <?php } else {  ?>
                                        <td class="quantity__item">
                                            <span class="badge bg-danger availability">Not Available</span>
                                        </td>
                                    <?php } ?>
                                    <td class="cart__close"><i class="fa fa-close remove_wishlist" data-wishlistid="<?php echo $row['Wishlist_Id']; ?>"></i></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

<?php
require('footer.php');
?>