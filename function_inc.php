<?php
// header page active funtion 
function isPageActive($pageName)
{
    $currentPage = basename($_SERVER['PHP_SELF']);
    if ($currentPage == $pageName) {
        echo 'class="active"';
    }
}

function getMainImageForProduct($productId, $conn)
{
    $query = "SELECT Product_Image_Path 
              FROM product_image 
              WHERE Product_Id = $productId 
              ORDER BY Product_Image_Id 
              LIMIT 1";

    $result = mysqli_query($conn, $query);
    // Check if there's a result
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['Product_Image_Path'];
    } else {
        // Return a default image path or handle the scenario as needed
        return "No Image Found";
    }
}

function getAllImageForProduct($productId, $conn)
{
    $product_image_array = array();
    $query = "SELECT Product_Image_Path 
              FROM product_image 
              WHERE Product_Id = $productId 
              ORDER BY Product_Image_Id";

    $result = mysqli_query($conn, $query);
    // Check if there's a result
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $product_image_array[] = $row['Product_Image_Path'];
        }
        return $product_image_array;
    } else {
        return "No Image Found";
    }
}


function get_product($conn, $category_id = null, $new_arrivals = false, $product_id = null)
{
    $products = array();

    // Prepare the SQL statement
    if ($category_id !== null) {

        if ($product_id !== null) {
            $sql = "SELECT p.`Product_Id`, p.`Product_Name`, p.`Price`
            FROM `product` p
            INNER JOIN `category` c ON p.`Category_Id` = c.`Category_Id`
            WHERE c.`Category_Id` = {$category_id} AND p.`Product_Id` != {$product_id}";
        } else {
            $sql = "SELECT p.`Product_Id`, p.`Product_Name`, p.`Price` 
                    FROM `product` p 
                    INNER JOIN `category` c ON p.`Category_Id` = c.`Category_Id` 
                    WHERE c.`Category_Id` = $category_id";
        }
    } else {
        if ($new_arrivals) {
            $sql = "SELECT `Product_Id`, `Product_Name`, `Price` 
            FROM `product` 
            ORDER BY `Product_Id` DESC";
        } else {
            $sql = "SELECT `Product_Id`, `Product_Name`, `Price` 
            FROM `product`";
        }
    }

    // Execute the query
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // Fetch results
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        // Free result set
        mysqli_free_result($result);
    }

    return $products;
}

function getProductByBrand($conn, $brand_id)
{
    $products = array();
    if ($brand_id != null) {
        $sql = "SELECT p.`Product_Id`, p.`Product_Name`, p.`Price` 
        FROM `product` p 
        INNER JOIN `brand` b ON p.`Brand_Id` = b.`Brand_Id`
        WHERE b.`Brand_Id` = $brand_id";
    }
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // Fetch results
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        // Free result set
        mysqli_free_result($result);
    }

    return $products;
}

function getProductDetails($conn, $id)
{
    $product_details = array();

    // Validate the ID
    if ($id !== null && (!is_numeric($id) || $id <= 0)) {
        // Handle invalid or empty ID
        return $product_details;
    }

    // Prepare the SQL statement
    if ($id !== null) {
        $sql = "SELECT p.`Product_Name`,p.`Mrp`, p.`Price`, p.`Quantity`, p.`Description`, b.`Brand_Name`, c.`Category_Name`, c.`Category_Id` 
        FROM `product` p 
        INNER JOIN `brand` b ON p.`Brand_Id` = b.`Brand_Id` 
        INNER JOIN `category` c ON p.`Category_Id` = c.`Category_Id` 
        WHERE p.`Product_Id` = $id";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            // Fetch results
            while ($row = mysqli_fetch_assoc($result)) {
                $product_details[] = $row;
            }
            // Free result set
            mysqli_free_result($result);
        }

        return $product_details;
    }
}



function get_category($conn)
{
    $sql = "SELECT `Category_Id`, `Category_Name`, `Category_Image` FROM `category`";
    $result = mysqli_query($conn, $sql);
    $category = array(); // Initialize an empty array to store products

    while ($row = mysqli_fetch_assoc($result)) {
        $category[] = $row;
    }
    return $category;
}

function get_product_features($conn, $product_id)
{
    if ($product_id != null) {
        $sql = "SELECT pf.Product_Features_Name, ppf.Features_Value 
        FROM product_has_product_features ppf
        INNER JOIN product_features pf ON ppf.Product_Features_Id = pf.Product_Features_Id
        WHERE ppf.Product_Id = $product_id";
        $result = mysqli_query($conn, $sql);
        $product_features = array();
    }

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $product_features[] = $row;
        }
        mysqli_free_result($result);
    }
    return $product_features;
}

//is product in the cart 
function isProductInCart($conn, $productId, $customerId)
{

    // Query to check if the product exists in the cart for the given customer
    $sql = "SELECT * FROM cart WHERE Product_Id = '$productId' AND Customer_Id = '$customerId'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful and if the product exists in the cart
    if ($result && mysqli_num_rows($result) > 0) {
        return true; // Product is in the cart
    } else {
        return false; // Product is not in the cart
    }
}

function getNoProductInCart($conn, $customerId)
{
    $sql = "SELECT COUNT(*) AS numProduct FROM cart WHERE Customer_Id = '$customerId'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $num = $row['numProduct'];
            return $num;
        }
    } else {
        echo mysqli_error($conn);
    }
}

//is product in the wishlist
function isProductInWishlist($conn, $productId, $customerId)
{

    // Query to check if the product exists in the wishlist for the given customer
    $sql = "SELECT * FROM wishlist WHERE Product_Id = '$productId' AND Customer_Id = '$customerId'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful and if the product exists in the wishlist
    if ($result && mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}


//generate random merchant id
function generateUniqueMTID()
{
    // Generate a random number to ensure uniqueness
    $randomNumber = mt_rand(100000000, 999999999);

    // Construct the MTID with the random number
    $mtid = 'MT' . $randomNumber;

    return $mtid;
}


function prx($arr)
{
    echo '
<pre>';
    print_r($arr);
    die();
}

function get_safe_value($conn, $str)
{
    if ($str != '') {
        $str = trim($str);
        return mysqli_real_escape_string($conn, $str);
    }
}

function redirectWithParams($path, $params = array())
{
    $query_string = http_build_query($params);
?>
    <script>
        window.location.href = "<?php echo $path . '?' . $query_string; ?>";
    </script>
<?php
}

function redirect($path)
{
?>
    <script>
        window.location.href = "<?php echo $path ?>";
    </script>
<?php
}
?>