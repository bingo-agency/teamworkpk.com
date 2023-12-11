<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
//include'../admin/includes/connection.php';
include'../admin/includes/dataBase.php';
$msg = '';

if (isset($_GET['user_id'])) {

    $user_id = $_GET['user_id'];
    $internal_lead_id = $_POST['internal_id'];
    $type = $_POST['type'];
    $purpose = $_POST['purpose'];
    $city = $_POST['city'];
    $location = $_POST['location'];
    $area = $_POST['area'];
    $price = $_POST['price'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $video_link = $_POST['video_link'];
    $comments = 'none';
    $floor_plans = 'none';
    $verification_status = '0';
    $featured = '0';
    $views = '0';
    $year_build = '2023';
    $property_type = $_POST['property_type'];


    $target_dir = "../upload/";
    $target_files = array();
    $target_files_name = array();


    foreach ($_FILES as $key => $file) {
        $target_file = 'upload/' . basename($file["name"]);
        $target_files_name[] = $target_file;
    }
    $primary_image = $target_files_name[0];
    $query = "INSERT INTO `web_posts` SET `internal_lead_id` = '" . $internal_lead_id . "',`purpose` = '" . $purpose . "',`primary_image` = '" . $primary_image . "' , `public_user_id` = '" . $user_id . "', `title` = '" . $title . "',`description` = '" . $description . "',`price` = '" . $price . "',`address` = '" . $location . "',`city` = '" . $city . "',`type` = '" . $type . "',`property_type` = '" . $property_type . "',`land_area` = '" . $area . "',`year_build` = '" . $year_build . "',`comments` = '" . $comments . "',`video_link` = '" . $video_link . "',`featured`  = '" . $featured . "',`floor_plans` = '" . $floor_plans . "',`verification_status` = '" . $verification_status . "',`views` = '0',`status` = 'new'";
    $queryInsert = mysqli_query($con, $query);
    $web_post_id = mysqli_insert_id($con);


    foreach ($_FILES as $key => $file) {
        $target_file = $target_dir . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            $target_files[] = $target_file;
        } else {
            echo "Error uploading file: " . $file["name"];
        }
        $finalFilesName = 'upload/'.basename($file['name']);
        $queryAddList = 'INSERT INTO `property_images` SET `web_post_id` = '.$web_post_id.',`image_link` = "'.$finalFilesName.'" ';
        $queryAdPhotos = mysqli_query($con,$queryAddList);   
    }


    echo json_encode($web_post_id);
} else {
    echo json_encode('Invalid User');
}
?>