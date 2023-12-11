<?php
session_start();

ob_start();
include 'includes/dataBase.php';
if (isset($_SESSION['user'])) {
    $db->add_user_activity($con,"Inactive user, Locked out for security");
    session_unset();
    session_destroy();
}

if (!isset($_SESSION)) {
    session_start();
}



if (!isset($_GET['id'])) {
    $db->redirect("login");
    exit();
} else {
    $id = $_GET['id'];
    $_SESSION['user']['id'] = $id;
}
?>
<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>LockScreen - Clients - Project100</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

    </head>

    <body class="gray-bg">

        <div class="lock-word animated fadeInDown">
            <span class="first-word">LOCKED</span><span>SCREEN</span>
        </div>
        <div class="middle-box text-center lockscreen animated fadeInDown">
            <div>
                <div class="m-b-md">
                    <img alt="image" class="img-circle circle-border" src="img/<?= $db->getEachById($con,'image', 'users', $id); ?>" style="max-width: 128px;">
                </div>
                <h3><?= $db->getEachById($con,'contact_name', 'users', $id); ?></h3>
                <p>Oops, we fell asleep. Due to inactivity on your account, we’ve locked the dashboard. Please enter your password to regain access.</p>

                <?php
                if (isset($_POST['submit'])) {
                    $password = $_POST['password'];

                    if (!empty($password)) {
                        if ($password == $db->getEachById($con,'password', 'users', $id)) {
                            $query = "SELECT * FROM `users` WHERE `email` = '{$db->getEachById($con,'email', 'users', $id)}' AND `password` = '{$db->getEachById($con,'password', 'users', $id)}'";
                            $res = mysqli_query($con,$query) or die(mysql_error());
                            $row = mysqli_fetch_array($res,MYSQLI_ASSOC);

                            if ($row) {
                                $_SESSION['user'] = $row;
                                if (isset($_SESSION['user'])) {
                                    $db->add_user_activity($con,"Logged back in from LockScreen");
                                    header('location:dashboard');
                                    exit();
                                }
                            } else {
                                $db->error('Your password is invalid');
                            }
                        } else {
                            $db->error('Your password is invalid');
                        }
                    }
                }
                ?>

                <form class="m-t" role="form" action="#" method="POST">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="******" required="" autocomplete="off">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary block full-width" value="Unlock">
                </form>
            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="js/jquery-2.1.1.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </body>

</html>