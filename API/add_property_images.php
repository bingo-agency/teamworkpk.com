<?php

header('Access-Control-Allow-Origin: *');
//header('Content-type: application/json');
include'../admin/includes/connection.php';
$msg = '';
$error = '';
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
} else {
    $post_id = '0';
    $msg = 'False';
    $error = 'No post id was set';
}
//$images[]  = $_FILES;
//print_r($images);
//exit();

//if(isset($_FILES['image'])) {
//  for($i=0;$i<count($_FILES);$i++) {
//    $uploadfile=$_FILES["image"]["tmp_name"][$i];
//    $folder="images/";
//    if (move_uploaded_file($_FILES["image"]["tmp_name"][$i], "$folder".$_FILES["image"]["name"][$i])) {
////            $error = "INSERT INTO `property_images` SET `web_post_id` = '" . $post_id . "', `image_link`='" . $value . "'";
////            exit();
//            $query = mysqli_query($con, "INSERT INTO `property_images` SET `web_post_id` = '" . $post_id . "', `image_link`=''images/'" . $_FILES["image"]["name"][$i] . "'");
//            if ($query) {
//                $msg = "True";
//            } else {
//                $msg = "False";
//                $error = 'Query Ended up being false.';
//            }
//        } else {
//            $error = 'Can not upload for some reason to ! /images/' . $_FILES["image"]["name"][$i];
//        }
//  }
//  $msg = $_FILES['image'];
//  exit();
//}
 


$image[] = $_FILES['image']['name'];
$tmpFile[] = $_FILES['image']['tmp_name'];

foreach ($image as $key => $value) {
    foreach ($tmpFile as $key => $tmpFilevalue) {
        if (move_uploaded_file($tmpFilevalue, '../upload/' . $value)) {
//            $error = "INSERT INTO `property_images` SET `web_post_id` = '" . $post_id . "', `image_link`='" . $value . "'";
//            exit();
            $query = mysqli_query($con, "INSERT INTO `property_images` SET `web_post_id` = '" . $post_id . "', `image_link` = 'upload/" . $value . "'");
            if ($query) {
                $msg = "True";
            } else {
                $msg = "False";
                $error = 'Query Ended up being false.';
            }
        } else {
            $error = 'Can not upload for some reason to ! /images/' . $value;
        }
    }
}





//if (isset($_FILES['image'])) {
//    $image = $_FILES['image']['name'];
//    $tmpname = $_FILES['image']['tmp_name'];
//    $name = '../upload/' . $_FILES['image']['name'];
////    $realImage = base64_decode($_FILES['image']['tmp_name']);
//    $target_dir = "../upload/";
//    $target_file = $target_dir .time(). $_FILES['image']['name'];
//    $uploadOk = 1;
//    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//} else {
//    $msg = "At least 1 to multiple images required to post Ads.";
//}
//if ($image > 6752033) {
//    $msg = "Sorry, your file is too large.";
//    $uploadOk = 0;
//}
//if ($uploadOk == 0) {
//    $uploadOk = $error;
//    $msg = "Sorry, your file was not uploaded.";
//} else {
//    if (move_uploaded_file($tmpname, $target_file )) {
//            $query_update_photo = mysqli_query($con, "INSERT INTO `property_images` SET `web_post_id` = '" . $post_id . "',`image_link` = '" . 'upload/' . time(). $image . "' ");
//            if ($query_update_photo) {
//                $msg = 'True';
////                $last_id = mysqli_insert_id($con);
//                
//            } else {
//                $msg = "Error saving db";
//            }
//            
//        } else {
//            $msg = "Sorry, there was an error uploading your file.";
//        }
//}


//$image = $_FILES['files']['name'];



//
//print_r($image);
//exit();
//$propertyImage =  $_FILES['files']['name'];
//$tmpFile[] = $_FILES['files']['tmp_name'];


//
//foreach ($images as $key => $value) {
//    foreach ($tmpFile as $key => $tmpFilevalue) {
//        if (move_uploaded_file($tmpFilevalue, 'images/' . $value)) {
////            $error = "INSERT INTO `property_images` SET `web_post_id` = '" . $post_id . "', `image_link`='" . $value . "'";
////            exit();
//            $query = mysqli_query($con, "INSERT INTO `property_images` SET `web_post_id` = '" . $post_id . "', `image_link`=''images/'" . $value . "'");
//            if ($query) {
//                $msg = "True";
//            } else {
//                $msg = "False";
//                $error = 'Query Ended up being false.';
//            }
//        } else {
//            $error = 'Can not upload for some reason to ! /images/' . $value;
//        }
//    }
//}



$arr[] = array('post_id' => $post_id, 'msg' => $msg,'name'=>$image,'tmp_name'=>$tmpFile, 'error' => $query);
$response ['addPropertyImages'] = $arr;
print json_encode($response);
