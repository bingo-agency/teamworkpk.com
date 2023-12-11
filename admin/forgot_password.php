<?php
ob_start();
include 'includes/dataBase.php';
session_start();

if (isset($_SESSION['user'])) {
    $db->redirect('dashboard');
}
?>
<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Register - Clients - Project100</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/intlTelInput.css">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

    </head>

    <?php
    if (isset($_GET['email'])) {
        $gottenEmail = $_GET['email'];
    }
    ?>

    <body class="gray-bg"style="background-color: #e6f1f8;">
        <div class="middle-box text-center    animated fadeInDown" >
            <div style="margin-top:50px;">
                <div>
                    <span class="logo-name"><img src="images/logo.png" class="img-responsive"/></span>
                </div>
                <h3>Forgot your password ? </h3>
                <p>Enter the email below to continue.</p>
                <?php
                if (isset($_POST['submit'])) {
                    $email = mysqli_real_escape_string($con, $_POST['email']);
                    $db->check_email($con, $email);
                    $dup = mysqli_query($con, "SELECT `email` FROM `users` WHERE `email` = '" . $email . "'");
                    if (mysqli_num_rows($dup) < 1) {
                        $db->error("This email address does not exist<br /> Try to <strong><a href='register'>Register</a></strong> for a new account.");
                    } else {
                        if (empty($email)) {
                            $db->error("Email is required!");
                        } else {
//                            $db->redirect('forgot_password?email=' . $email);
                            $db->success("A link has been sent to your email.");
                        }
                    }
                }
                ?>
                <form class="m-t" role="form" action="#" method="POST">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" required="" name="email" value="<?php
                        if (!empty($gottenEmail)) {
                            echo $gottenEmail;
                        } else if (isset($_POST['email'])) {
                            echo $_POST['email'];
                        }
                        ?>">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary block full-width m-b" value="Send">

                    <p class="text-muted text-center"><small>Already have an account?</small></p>
                    <a class="btn btn-sm btn-white btn-block" href="login">Login</a>
                </form>
                <p class="m-t"> <small>Project 100 ® &copy; 20<?= date('y') ?></small> </p>
            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="js/jquery-2.1.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
//                $('.hiddenradio').click(function () {
//                    console.log($('[type=radio]:checked').val());
//                });

            });
        </script>
        <script src="js/intlTelInput.js"></script>
        <script>
            $("#mobile-number").intlTelInput();
        </script>
    </body>

</html>
