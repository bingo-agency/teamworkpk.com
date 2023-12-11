<?php
ob_start();
include 'includes/dataBase.php';
session_start();

if (isset($_SESSION['user'])) {
    header("Location:dashboard");
    exit();
}

include 'includes/loginprocess.php';
?>
<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Login - TeamWork</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

    </head>

    <body class="gray-bg"style="background-color: #e6f1f8;">

        <div class="middle-box text-center loginscreen animated fadeInDown" style="margin-top:-230px;">
            <div>
                <div>

                    
                    <center>
                        <a href="../"><img src="../img/teamWrk.png" class="img-responsive"  style="padding:50px;"/></a>
                    </center>

                </div>
                <h3>Welcome to our TeamWork Portal</h3>
                <p>Access team internal affairs.</p>

                <?php
                if ($error_msg != "") {
                    $db->error($error_msg);
                }
                ?>

                <p>Login in. To see it in action.</p>
                <br>
                <form class="m-t" role="form" action="login" method="POST">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email or Username" class="form-control" required="" value="<?php
                        if (isset($email)) {
                            echo $email;
                        } else if (isset($_GET['email'])) {
                            echo $_GET['email'];
                        }
                        ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" >
                    </div>
                    <input type="submit" name="Submit" class="btn btn-primary loginBtn block full-width m-b" value="Login" />
                    <?php
                    if (isset($email)) {
                        $forgotpasslink = "forgot_password?email=" . $email;
                    } else {
                        $forgotpasslink = "forgot_password";
                    }
                    ?>

                    <a href="<?= $forgotpasslink ?>"><small>Forgot password</small></a>
                    <!--<p class="text-muted text-center"><small>Don't have an account?</small></p>-->
                    <!--<a class="btn btn-sm btn-white btn-block" href="register">Create an account</a>-->
                </form>
                <p class="m-t"> <small>TeamWork &copy; 20<?= date('y') ?></small> </p>
            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>

</html>
