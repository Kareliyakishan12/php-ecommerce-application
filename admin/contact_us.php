<?php
require('header.php');
$sql = "SELECT `contacts_id`, `name`, `email`, `mobile`, `subject`, `message` FROM `contacts`";
$res = mysqli_query($conn, $sql);

?>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Contact Us</strong>
                    </div>
                    <div class="card-body">
                        <div class="text-success mb-4">
                            <?php
                            if (isset($_SESSION['delete_msg'])) {
                                echo ucfirst($_SESSION['delete_msg']);
                                unset($_SESSION['delete_msg']);
                            }
                            ?>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $num = 1;
                                while ($row = mysqli_fetch_assoc($res)) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $num; ?></th>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['mobile']; ?></td>
                                    <td><?php echo $row['subject']; ?></td>
                                    <td><?php echo $row['message']; ?></td>
                                </tr>
                                <?php $num = $num + 1;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
<?php
require('footer.php');
?>