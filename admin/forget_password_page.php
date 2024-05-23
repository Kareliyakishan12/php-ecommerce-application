<?php
require('db_connect_inc.php');
require('function_inc.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$connection = mysqli_connect("localhost", "root", "", "techworld");
if ($_POST) {
    $email = $_POST['email'];
    $q = mysqli_query($connection, "select * from admin where Email='{$email}'");

    $count = mysqli_num_rows($q);
    if ($count == 1) {
        $data = mysqli_fetch_array($q);

        $mailpass = "Password: <b>" . $data['Password'] . "</b>";
        $name = $data['User_Name'];

        $msg = "<html>
          <p>Dear Admin $name,</p></br>
          <p>As requested, here is your password for your <b>TechWorld</b> account</p></br>
          <p>$mailpass</p></br>
          <p>Please remember to keep your password secure and do not share it with anyone. If you have any concerns or did not send this information to anyone.</p>
          <p>Thank you,<br>
          TechWorld Team</p>
        </body>
        </html>";


        require('vendor/autoload.php');

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
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Techworld Admin Panel</title>
    <meta name="description" content="Techworld Admin Panel">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<style>
    body {
        background-color: rgba(0, 0, 0, .03);
    }
</style>

<body>

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-form">
                    <div class="login-logo">
                        <img class="align-content" src="images/logo3.png" alt="">
                    </div>
                    <?php
                    if (isset($_SESSION['login_msg'])) {
                        echo $_SESSION['login_msg'];
                        unset($_SESSION['login_msg']);
                    }
                    ?>
                    <form action="forget_password_page.php" method="post">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <button type="submit" name="submit" class="btn redbtn btn-flat m-b-30 m-t-30">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>