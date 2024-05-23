<?php
require('header.php');
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $license_no = $_POST['license_no'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO `delivery_person`(`Name`, `Email`, `Password`, `License_Number`, `Gender`) VALUES ('$name','$email','$password','$license_no','$gender')";

    if (mysqli_query($conn, $sql)) {
        $sucess_msg = "New Delivery Boy added successfully!";
    } else {
        $error_msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Add Delivery Person</strong>
                    </div>
                    <div class="card-body card-block">
                        <?php if (isset($sucess_msg)) { ?>
                        <h4 class="form-text mb-4 <?php echo "text-success" ?>">
                            <?php echo $sucess_msg;
                                unset($sucess_msg); ?>
                        </h4>
                        <?php } ?>
                        <?php if (isset($error_msg)) { ?>
                        <h4 class="form-text mb-4 <?php echo "text-danger" ?>">
                            <?php echo $error_msg;
                                unset($error_msg); ?>
                        </h4>
                        <?php } ?>
                        <form action="add_delivery_person.php" method="post" class="form-horizontal">
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input"
                                        class=" form-control-label">Name:</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="name"
                                        placeholder="Name" class="form-control"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="select"
                                        class=" form-control-label">Gender:</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="gender" class="form-control">
                                        <option>Please select</option>
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input"
                                        class=" form-control-label">Email:</label></div>
                                <div class="col-12 col-md-9"><input type="email" class="form-control"
                                        id="exampleInputEmail1" aria-describedby="emailHelp" name="email"
                                        placeholder="Enter email">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input"
                                        class=" form-control-label">Password:</label></div>
                                <div class="col-12 col-md-9"><input type="password" id="text-input" name="password"
                                        placeholder="Password" class="form-control"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">License
                                        Number:</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="license_no"
                                        placeholder="License No" class="form-control"></div>
                            </div>
                            <div class="row">
                                <div class="col mt-4">
                                    <button type="submit" name="submit" class="btn btn-success">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>

        </div>


    </div><!-- .animated -->
</div><!-- .content -->

<?php
require('footer.php');
?>