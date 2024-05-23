<?php


function isPageActive($pageName)
{
    $currentPage = basename($_SERVER['PHP_SELF']);
    if ($currentPage == $pageName) {
        echo "active";
    }
}

function prx($arr)
{
    echo '<pre>';
    print_r($arr);
    die();
}


function getNextID($conn, $tableName, $columnName)
{
    $sql = "SELECT MAX($columnName) AS max_id FROM $tableName";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $nextID = $row['max_id'] + 1;
    return $nextID;
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