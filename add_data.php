<?php

include'admin/includes/dataBase.php';
//require_once './phpmailer/PHPMailerAutoload.php';

session_start();
$uploaded = false;
// print_r($_FILES['file']);

if (!$_SESSION['public_user']) {
    $db->redirect('login');
}
if (isset($_POST['id'])) {

    $city = mysqli_real_escape_string($con, $_POST['city']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $year_build = mysqli_real_escape_string($con, $_POST['year_build']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $land_area = mysqli_real_escape_string($con, $_POST['land_area']);
    $unit_size = mysqli_real_escape_string($con, $_POST['unit_size']);
    $by_id = mysqli_real_escape_string($con, $_POST['id']);
    $purpose = mysqli_real_escape_string($con, $_POST['purpose']);
    $property_type = mysqli_real_escape_string($con, $_POST['property_type']);
    $floor_plans = 'none';
    $comments = 'none';




//    $filename = $_FILES['file']['name'];
//     if (isset($_FILES['file']['name'])) {
// //        $filenameattach = tempnam(sys_get_temp_dir(), sha1($_FILES['file']['name']));
//         $filename = $_FILES['file']['name'];
//         $fileTmpName = $_FILES['file']['tmp_name'];
//     }
//     $file_location = "upload/" . time() . $filename;


//     if (move_uploaded_file($_FILES['file']['tmp_name'], $file_location)) {
//         $file_location . "File uploaded!";
//         $uploaded = true;
//     } else {
//         echo '0' . "File didn't upload!";
//     }


         $query = mysqli_query($con, "INSERT INTO `web_posts` SET `title` = '" . $title . "',`description` = '" . $description . "',`price` = '" . $price . "',`address` = '" . $location . "',`city` = '" . $city . "',`views` = '0',`type`='" . $type . "',`purpose` = '" . $purpose . "',`land_area` = '" . $land_area . "',`unit_size` = '". $unit_size ."',`year_build` = '" . $year_build . "',`floor_plans` = '" . $floor_plans . "',`public_user_id` = '" . $by_id . "',`comments` = '" . $comments . "',`property_type` = '" . $property_type . "'");
//        $query1 = mysqli_query($con, $query);
        if (!$query) {
            echo $query1 . "Query here !!!" . $query;
//        $db->error('<strong>Server Error:</strong> Try again or contact the admin support.');
        } else {
//            echo 'cool';
            echo $db->lastID($con);
        }
    }
?>