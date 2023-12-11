<?php

include'admin/includes/dataBase.php';
//require_once './phpmailer/PHPMailerAutoload.php';

session_start();
$uploaded = false;

if (!$_SESSION['public_user']) {
    $db->redirect('login');
}
if (isset($_POST['web_post_id'])) {
    $web_post_id = $_POST['web_post_id'];

//    $filename = $_FILES['file']['name'];
    if (isset($_FILES['file']['name'])) {
//        $filenameattach = tempnam(sys_get_temp_dir(), sha1($_FILES['file']['name']));
        $filename = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
    }
    $file_location = "upload/" . time() . $filename;


    if (move_uploaded_file($_FILES['file']['tmp_name'], $file_location)) {
        $file_location . "File uploaded!";
        $uploaded = true;
    } else {
        echo '0' . "File didn't upload!";
    }
    if ($uploaded == true) {
        $query = mysqli_query($con, "INSERT INTO `property_images` SET `web_post_id` = '" . $web_post_id . "',`image_link` = '" . $file_location . "'");
        if (!$query) {
            echo 'nope';
        } else {
            echo 'yes';
        }
    }
}

    