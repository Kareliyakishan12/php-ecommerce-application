<?php
require('header.php');

if (isset($_POST['submit'])) {
    $name = get_safe_value($conn, $_POST['Name']);
    $email = get_safe_value($conn, $_POST['Email']);
    $mobile = get_safe_value($conn, $_POST['Mobile']);
    $subject = get_safe_value($conn, $_POST['Subject']);
    $message = get_safe_value($conn, $_POST['Message']);

    $sql = "INSERT INTO `contacts`(`name`, `email`, `mobile`, `subject`, `message`) 
            VALUES ('$name','$email','$mobile','$subject','$message')";


    $result = mysqli_query($conn, $sql);
    if ($result) {
        $msg = "Thank you for contacting us! Your message has been successfully submitted.";
    } else {
        // Display or log the error message
        $error_msg = mysqli_error($conn);
        echo "Error: " . $error_msg;
    }
}
?>


<section class="contact spad contact-spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 my-3">
                <div class="text-success">
                    <?php if (isset($msg)) {
                        echo $msg;
                    } ?></div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Information</span>
                        <h2>Contact Us</h2>
                        <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                            strict attention.</p>
                    </div>
                    <ul>
                        <li>
                            <h4>TechWorld Mobile Shop</h4>
                            <p>Created By Kishan Kareliya <br />+91 8160273697</p>
                        </li>
                        <li>
                            <h4>Email</h4>
                            <p>kareliyakishan007@gmail.com</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__form">
                    <form action="contact.php" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="Name" placeholder="Name" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="Email" placeholder="Email" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="number" name="Mobile" placeholder="Mobile No" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="Subject" placeholder="Subject" required>
                            </div>
                            <div class="col-lg-12">
                                <textarea name="Message" placeholder="Message"></textarea>
                                <button type="submit" name="submit" class="site-btn">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->
<script src="https://kit.fontawesome.com/b698c5767d.js" crossorigin="anonymous"></script>
<?php
require('footer.php');
?>