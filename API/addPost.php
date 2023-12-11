<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
include'../admin/includes/connection.php';
$msg = '';

$image = $_POST['image'];
$name = $_POST['name'];
$img = base64_decode($image);
$image = $name;
$last_id = '0';


if (isset($_GET['purpose']) && isset($_GET['type']) && isset($_GET['city']) && isset($_GET['address']) && isset($_GET['price']) && isset($_GET['year_build']) && isset($_GET['title']) && isset($_GET['description']) && isset($_GET['user_id'])) {
    $purpose = $_GET['purpose'];
    $property_type = $_GET['property_type'];
    $type = $_GET['type'];
    $city = $_GET['city'];
    $address = $_GET['address'];
    $year_build = $_GET['year_build'];
    $area = $_GET['area'];
    $price = $_GET['price'];
    $title = $_GET['title'];
    $description = $_GET['description'];
    $user_id = $_GET['user_id'];
    $land_area = $_GET['area'];
    $comments = 'none';
    $video_link = '';
    $floor_plans = 'none';
    $verification_status = '0';
    $featured = '0';
} else {
    $msg = 'no id was inserted';
}
if (isset($_POST['image'])) {
    $image = $_POST['image'];
    $name = '../upload/' . $_POST['name'];
    $realImage = base64_decode($image);
    $target_dir = "../upload/";
    $target_file = $target_dir . basename($realImage) . time();
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
} else {
    $msg = "At least 1 to multiple images required to post Ads.";
}

if ($realImage > 6752033) {
    $msg = "Sorry, your file is too large.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    $msg = "Sorry, your file was not uploaded.";
} else {

    if ($purpose == '' || $title == '' || $price == '') {
        $msg = 'Title, Price & Purpose is required.';
    } else {
        if (file_put_contents($name, $realImage)) {
            $query_update_photo = mysqli_query($con, "INSERT INTO `web_posts` SET `purpose` = '" . $purpose . "',`primary_image` = '" . 'upload/' . $_POST['name'] . "' , `public_user_id` = '" . $user_id . "', `title` = '" . $title . "',`description` = '" . $description . "',`price` = '" . $price . "',`address` = '" . $address . "',`city` = '" . $city . "',`type` = '" . $type . "',`property_type` = '" . $property_type . "',`land_area` = '" . $land_area . "',`year_build` = '" . $year_build . "',`comments` = '" . $comments . "',`video_link` = '" . $video_link . "',`featured`  = '" . $featured . "',`floor_plans` = '" . $floor_plans . "',`verification_status` = '" . $verification_status . "',`views` = '0',`status` = 'new'");
            if ($query_update_photo) {
                $msg = 'True';
                $last_id = mysqli_insert_id($con);
            } else {
                $msg = "Error saving db";
            }
        } else {
            $msg = "Sorry, there was an error uploading your file.";
        }
    }

    $arr[] = array('last_id' => $last_id, 'msg' => $msg);
    $respond ['adpost'] = $arr;
    print json_encode($respond);
}