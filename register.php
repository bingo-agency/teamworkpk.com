<?php
include'includes/header.php';

if (isset($_SESSION['public_user'])) {
    $db->redirect('add_property');
}
?>

<style>
    body{

        overflow-x: hidden;
    }
    .tw-roundedCircle{
        min-height: 300px;
        position: absolute;
        min-width: 300px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
    }

</style>
<div class="tw-roundedCircle" style="z-index: 1;top:3.5%;
     opacity: 0.7;right: -12%;background-image: url(img/banner/banner6.png)">

</div>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-content" style="


                     color: inherit;
                     background-size: cover;">
                    <div class="row">
                        <div class="col-lg-6 hidethislogin" style="
                             min-height: 120vh;
                             z-index: 2;
                             border-radius: 10px 0px 0px 10px;
                             background: #C04848;  /* fallback for old browsers */
                             background: linear-gradient(to bottom, #480048, #0e2e5096);">
                            <div class="" style='padding:10px;margin-left:10px;'>

                                <center><img src="img/logoGreen.png" /></center>
                                <div class="" style='padding-top:100px;padding-left:10px;'>
                                    <h1 style="font-family: Gotham;color:#fff;font-weight: 500">Welcome to,<br /> TeamWork</h1>
                                    <p style="font-family: Gotham;color:#fff;font-weight: 500">Register to the most exciting database.</p>
                                    <p style="font-family: Gotham;color:#fff;font-weight: 500">Already a user?</p>
                                </div>
                                <div style='padding-top:10px;'>
                                    <a href="login" class="btn-block btn btn-primary btn-lg" style="width:300px;">Login</a>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6 right-mobile">
                            <div class="center-block">
                                <h1 style="font-weight: 600;padding-top: 125px;padding-bottom: 25px;color: #6f1c74;">Register</h1>
                            </div>
                            <?php
                            if (isset($_POST['submit'])) {

                                $name = mysqli_real_escape_string($con, $_POST['name']);
                                $email = mysqli_real_escape_string($con, $_POST['email']);
                                $password = mysqli_real_escape_string($con, $_POST['password']);
                                $phone = mysqli_real_escape_string($con, $_POST['phone']);
                                $image = 'img/avatar.svg';

                                $db->check_public_email($con, $email);


                                $dup = mysqli_query($con, "SELECT `email` FROM `public_users` WHERE `email` = '" . $email . "'");
                                if (mysqli_num_rows($dup) > 0) {
                                    $db->error_front("This email address already exists, Try to <a href='login'>Login</a> to your account.");
                                } else {
                                    if (empty($email) || empty($password) || empty($phone) || empty($name)) {
                                        $db->error_front("All fields are required!");
                                    } elseif (strlen($password) < 5) {
                                        $db->error_front("Your password should be at least 6 characters long.");
                                    } elseif (empty($phone)) {
                                        $db->error_front("Your Phone is required.");
                                    } else {
                                        $query = mysqli_query($con, "INSERT INTO `public_users` SET `email` = '" . $email . "', `password` = '" . $password . "', `name` = '" . $name . "', `image` = '" . $image . "',`phone` = '" . $phone . "'");
                                        if (!$query) {
//                                echo "INSERT INTO `users` SET `email` = '" . $email . "', `password` = '" . $password . "', `contact_name` = '" . $contact_name . "', `telephone` = '" . $telephone . "', `role` = '" . $role . "', `image` = '" . $image . "'";
                                            $db->error_front("Your request can't be completed at the moment, please contact the admin support.");
                                        } else {
                                            $db->redirect('login?email=' . $email);
                                        }
                                    }
                                }
                            }
                            ?>
                            <form action="#" method="POST" class="form-horizontal">

                                <div class="form-group">
                                    <label class="col-lg-6 control-label">Name</label>
                                    <div class="col-sm-6"><input type="text" class="form-control" name="name" value="<?php
                                        if (isset($_POST['name'])) {
                                            echo $_POST['name'];
                                        }
                                        ?>" placeholder="Name"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-6 control-label">Email</label>
                                    <div class="col-sm-6"><input type="email" class="form-control" name="email" value="<?php
                                        if (isset($_POST['email'])) {
                                            echo $_POST['email'];
                                        }
                                        ?>" placeholder="Email"></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-6 control-label">Password</label>
                                    <div class="col-sm-6"><input type="password" class="form-control" name="password" placeholder="Password"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-6 control-label">Phone Number</label>
                                    <div class="col-sm-6"><input type="tel" class="form-control" name="phone" required="" placeholder="0333571xxxx"></div>
                                </div>
                                <input type="checkbox" required="" /> I accept all the <a href="terms">terms & Conditions</a>.



                                <div class="form-group">
                                    <div class="col-lg-6 col-sm-offset-2">

                                        <input name="submit" class="btn-block btn-lg btn btn-primary col-lg-12" type="submit" value="Register" />
                                    </div>
                                </div>
                            </form>
                            <hr />
                            <p>Already a user ? <a href="login">Login</a> instead</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tw-roundedCircle hidethislogin" style="top:8.5%;left: -10%;bottom:15%;min-height:250px;width:300px;background-image: url(img/banner/banner4.png)">

        </div>

    </div>

</div>

<?php include'includes/footer.php'; ?>
<script>
    $(document).ready(function () {
        $('.rt-header').removeClass('sticky-on');
    });

</script>
