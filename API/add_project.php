<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
include'../admin/includes/connection.php';
$msg = '';

$image = $_POST['image'];
$name = $_POST['name'];
$img = base64_decode($image);
$project_id = '0';

if (isset($_POST['image']) && isset($_GET['user_id']) && isset($_GET['title'])) {
    $image = $_POST['image'];
    $name = '../upload/' . $_POST['name'];
    $realImage = base64_decode($image);
    $target_dir = "../upload/";
    $target_file = $target_dir . basename($realImage) . time();
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $user_id = $_GET['user_id'];
    $title = $_GET['title'];
    
    
    if ($realImage > 6752033) {
        $msg = "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        $msg = "Sorry, your file was not uploaded.";
    } else {

        if ($title == '' || $user_id == '') {
            $msg = 'Title is required.';
        } else {
            if (file_put_contents($name, $realImage)) {
                $query_update_photo = mysqli_query($con, "INSERT INTO `project` SET `user_id` = '" . $user_id. "',`primary_image` = '" . 'upload/' . $_POST['name'] . "' , `user_id` = '" . $user_id . "' ");
                if ($query_update_photo) {
                    $msg = 'True';
                    $project_id = mysqli_insert_id($con);
                } else {
                    $msg = "Error saving db";
                }
            } else {
                $msg = "Sorry, there was an error uploading your file.";
            }
        }
    } 
    $arr[] = array('last_id'=>$last_id,'msg' => $msg);
    $respond ['adpost'] = $arr;
    print json_encode($respond);
}
