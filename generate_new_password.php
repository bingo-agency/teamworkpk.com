<?php include'./includes/header.php'; ?>
<?php
if (isset($_GET['id'])) {
    $generated_id = $_GET['id'];
    $from_email = $db->getEmailByMd5($con, 'email', $generated_id);
} else {
    $db->redirect('login');
    exit();
}
?>
<div class="row" style="min-height:100vh">
    <div class="container">
        <center><img src="https://teamworkpk.com/img/teamWrk.png" width:200px></center>
        <h1>Recover Password </h1>
        <center>
            <div>
                <?php
                if (isset($_POST['Submit'])) {
                    $password = $_POST['password'];
                    $confirm_password = $_POST['confirm_password'];
                    if (strlen($password) < 5) {
                        $db->error("Your password must be  at least 5 characters long.");
                    } else {
                        if ($password != $confirm_password) {
                            $db->error("Your passwords do not match.");
                        } else {
                            $query = mysqli_query($con, "UPDATE `public_users` SET `password` = '" . $password . "' WHERE `email` = '" . $from_email . "'");
                            if ($query) {
                                $db->success('your password has been updated.');
                            } else {
                                $db->error('Error in query');
                            }
                        }
                    }
                }
                ?>

                <form action="#" method="POST" class="form-horizontal">
                    <?php
                    if (empty($from_email)) {
                        $db->redirect('login');
                        echo 'empty';
                    }
                    ?>
                    <!--                    <div class="form-group">
                                            <label class="col-lg-2 control-label">Email</label>
                                            <div class="col-sm-4">
                                                <input type="email" class="form-control" name="email" value="<?php
//                    if (isset($_POST['email'])) {
//                        echo $_POST['email'];
//                    } else {
//                        echo $db->getEmailByMd5($con, $generated_id);
//                    }
                    ?>" placeholder="Email">
                                            </div>
                                        </div>-->
                    <div class="form-group">
                        <label class="col-lg-2 control-label">New Password</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password"  placeholder="New Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Confirm Password</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="confirm_password"  placeholder="Confirm New Password">
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-lg-4 col-sm-offset-2">
                            <input name="Submit" class="btn btn-primary col-lg-12" type="submit" value="Reset" />
                        </div>
                    </div>
                </form>
            </div>
        </center>

    </div>
</div>




<?php include'./includes/footer.php'; ?>