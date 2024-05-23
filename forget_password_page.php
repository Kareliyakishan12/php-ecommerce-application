<?php
require_once('db_connect.php');
require_once('function_inc.php');
?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$connection = mysqli_connect("localhost", "id22095435_kareliyakishan007", "Kishan@2003", "id22095435_techworld");
if ($_POST) {
    $email = $_POST['email'];
    $q = mysqli_query($connection, "select * from customer where Email='{$email}'");

    $count = mysqli_num_rows($q);
    if ($count == 1) {
        $data = mysqli_fetch_array($q);
        //echo $data['emp_password'];

        $mailpass = "Password: <b>" . $data['Password'] . "</b>";
        $name = $data['First_Name'] . ' ' . $data['Last_Name'];

        $msg = "<html>
          <p>Dear Customer $name,</p></br>
          <p>As requested, here is your password for your <b>TechWorld</b> account</p></br>
          <p>$mailpass</p></br>
          <p>Please remember to keep your password secure and do not share it with anyone. If you have any concerns or did not send this information to anyone.</p>
          <p>Thank you,<br>
          TechWorld Team</p>
        </body>
        </html>";


        require 'vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'kareliyakishan007@gmail.com';                     //SMTP username
            $mail->Password   = 'goofcarxekuoeiwi';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('kishankareliya223@gmail.com', 'TechWord');
            $mail->addAddress($email, $name);     //Add a recipient


            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Techworld Forgetted Password';
            $mail->Body    = $msg; //"Password is ".$data['upass'];
            $mail->AltBody = $msg; //"Password is ".$data['upass'];

            $mail->send();
            echo "<script>alert('Password send your email');</script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script>alert('User Not Found');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="TechWorld">
    <meta name="keywords" content="Techworld">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TechWorld</title>

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
        width: 530px;
        background-color: #fff;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form {
        padding: 45px;
    }

    .logo {
        text-align: center;
        margin-bottom: 24px;
    }

    .logo img {
        width: 250px;
    }

    input[type="email"],
    input[type="password"],
    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 1rem;
    }


    button[type="submit"] {
        width: 50%;
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

    .back_login {
        width: 50%;
        padding: 11px 92px;
        background-color: #419873;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
    }

    .back_login:hover {
        background-color: #398564;
    }

    small {
        color: #f00;
        display: block;
        margin-top: 8px;
    }

    .form-select {
        margin-bottom: 18px;
    }
</style>

<body>
    <div class="login-page">
        <div class="form">
            <div class="login">
                <div class="logo">
                    <img src="img/logo3.png" alt="Logo">
                </div>
                <form action="forget_password_page.php" method="post">
                    <input type="email" name="email" placeholder="Email" required>
                    <a href="login_page.php" class="back_login">Back</a>
                    <button type="submit" name="submit">Submit</button>
                </form>
                <small class="form-text text-danger"><?php if (isset($error_msg)) {
                                                            echo $error_msg;
                                                        } ?></small>
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