<?php
require_once('db_connect.php');
require_once('function_inc.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `customer` WHERE `Email` = '$email' AND `Password` = '$password'";

    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);

        $_SESSION['login'] = true;
        $_SESSION['Customer_Id'] = $row['Customer_Id'];

        redirect("index.php");
    } else {
        $error_msg = "Username or Password is incorrect";
    }
}

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Techworld</title>

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

<style>
    body {
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        padding: 0;
    }

    .login-page {
        width: 500px;
        background-color: #fff;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form {
        padding: 24px;
    }

    .logo {
        text-align: center;
        margin-bottom: 24px;
    }

    .logo img {
        width: 250px;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 14px;
    }


    button[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: rgb(251, 16, 16);
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #EF0107;
    }

    small {
        color: #f00;
        display: block;
        margin-top: 8px;
    }

    .link {
        text-align: center;
        margin-top: 10px;
        font-size: 14px;
    }

    .link a {
        color: rgb(251, 16, 16);
        text-decoration: none;
    }

    .link a:hover {
        text-decoration: underline;
    }
</style>

<body>
    <div class="login-page">
        <div class="form">
            <div class="login">
                <div class="logo">
                    <img src="img/logo3.png" alt="Logo">
                </div>
                <small class="form-text text-danger">
                    <?php if (isset($_SESSION['login_msg'])) {
                        echo $_SESSION['login_msg'];
                        unset($_SESSION['login_msg']);
                    }
                    ?>
                </small>
                <form action="login_page.php" method="post">
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" name="submit">Sign in</button>
                </form>
                <small class="form-text text-danger">
                    <?php if (isset($error_msg)) {
                        echo $error_msg;
                    } ?>
                </small>
                <p class="link"><a href="forget_password_page.php">Forgotten Password?</a></p>
                <p class="link">Don't have account ? <a href="register_page.php"> Sign Up Here</a></p>
            </div>
        </div>
    </div>

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>