<?php

include'admin/includes/dataBase.php';
//require_once './phpmailer/PHPMailerAutoload.php';

session_start();
// Count total files
// print_r($_FILES['file']['tmp_name']);
// echo $countfiles = count($_FILES['file']['name']);

$web_post_id = $_GET['web_post_id'];
// echo $web_post_id;

// Upload directory
$upload_location = "upload/";

// To store uploaded files path
$files_arr = array();

// Loop all files
// for ($index = 0; $index < $countfiles; $index++) {

    // if (isset($_FILES['file']['name'][$index]) && $_FILES['file']['name'][$index] != '') {
/* this is comment create with shift alt A */
        // File name
        if(isset($_FILES['file']['name'])) {
        $filename = $_FILES['file']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png", "jpeg", "jpg");

        // Check extension
        if (in_array($ext, $valid_ext)) {

            // File path
            $path = $upload_location . time() . rand(0,999999) . $filename;

            // Upload file
            if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
                $files_arr[] = $path;
                $add_image = mysqli_query($con, "INSERT INTO `property_images` SET `web_post_id` = '" . $web_post_id . "',`image_link` = '" . $path . "'");
                $result = mysqli_query($con, "SELECT LAST_INSERT_ID()");
                $row = mysqli_fetch_array($result);
                array_push($files_arr, $row[0]);
            }
        }
    }
//     }
// }

echo json_encode($files_arr);
die;
