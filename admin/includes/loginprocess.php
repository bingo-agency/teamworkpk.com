<?php

require_once 'dataBase.php';
$error_msg = "";
if (isset($_POST['Submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}' AND status = 'Active'";
//    $query = "SELECT * FROM `users` WHERE `email` = '{$email}' AND `password` = '{$password}' ";

    $res = mysqli_query($con, $query) or die(mysqli_error($con));
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

    if ($row) {
        $_SESSION['user'] = $row;
        $db->add_user_activity($con, "Logged In");
        header('location:dashboard');
        exit();
    } else {
        return $error_msg = "Invalid Email/Password or Blocked user.";
    }
}
?>