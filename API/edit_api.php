<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
include'../admin/includes/connection.php';


    if (isset($_GET['id'])) {
        $web_post_id=$_GET['id'];
        // $query =   "UPDATE `web_posts`  SET `internal_lead_id` = '" . $internal_lead_id . "',`title` = '" . $title . "', `featured` = '" . $featured . "', `description` = '" . $description . "',`price` = '" . $price . "', `address` = '" . $address . "', `city` = '" . $city . "',`type`='" . $type . "',`property_type` = '" . $property_type . "',`purpose` = '" . $purpose . "',`land_area` = '" . $land_area . "' ,`year_build` = '" . $year_build . "',`video_link` = '" . $video_link . "',`verification_status` = '" . $verification_status . "' WHERE `id` = '" . $web_post_id . "'";
// $data="";
        // while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        // $web_post_id = $data['id'];
        $internal_lead_id = $_GET['internal_lead_id'];
        $title = $_GET['title'];
        $desc = $_GET['description'];
        $price = $_GET['price'];
        $address = $_GET['address'];
        $city = $_GET['city'];
        // $views = $_GET['views'];
        $type = $_GET['type'];
        $property_type = $_GET['property_type'];
        $purpose = $_GET['purpose'];
        $land_area = $_GET['land_area'];
        $year_build = $_GET['year_build'];
        // $primary_image = 'https://teamworkpk.com/'.$_GET['primary_image'];
        // $floor_plans = $_GET['floor_plans'];
        // $public_id = $_GET['public_user_id'];
        // $comments = $_GET['comments'];
        $video_link = $_GET['video_link'];
        $verification_status = $_GET['verification_status'];
        $featured = $_GET['featured'];
        // $timestamp = $data['timestamp'];
        // }
        // if (empty($web_post_id)) {
        //     $resultData = 'please enter id';
        // }    
        $arr = array('id' => $web_post_id,'internal_lead_id' => $internal_lead_id, 'title'=>$title, 'description' => $desc, 'price'=>$price, 'address'=>$address, 'city'=>$city, 'type'=>$type, 'property_type'=>$property_type, 'purpose'=>$purpose, 'land_area'=>$land_area, 'year_build'=>$year_build, 'video_link'=>$video_link, 'verification_status'=>$verification_status, 'featured'=>$featured);

    if(!empty($web_post_id)){
        
        $query =   "UPDATE `web_posts`  SET `internal_lead_id` = '" . $internal_lead_id . "',`title` = '" . $title . "', `featured` = '" . $featured . "', `description` = '" . $desc . "',`price` = '" . $price . "', `address` = '" . $address . "', `city` = '" . $city . "', `type`='" . $type . "',`property_type` = '" . $property_type . "',`purpose` = '" . $purpose . "',`land_area` = '" . $land_area . "' ,`year_build` = '" . $year_build . "',`video_link` = '" . $video_link . "',`verification_status` = '" . $verification_status . "' WHERE `id` = '" . $web_post_id . "'";

        // while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        //     $arr[] = array('id' => $row['id'], 'internal_lead_id' => $row['internal_lead_id'], 'title' => $row['title'], 'description' => $row['description'], 'price' => $row['price'], 'address' => $row['address'], 'city' => $row['city'], 'views' => $row['views'], 'type' => $row['type'], 'property_type' => $row['property_type'], 'purpose' => $row['purpose'], 'land_area' => $row['land_area'], 'year_build' => $row['year_build'], 'primary_image' => 'https://teamworkpk.com/'.$row['primary_image'], 'floor_plans' => $row['floor_plans'], 'public_user_id' => $row['public_user_id'], 'comments' => $row['comments'], 'video_link' => $row['video_link'], 'verification_status' => $row['verification_status'], 'featured' => $row['featured'], 'timestamp' => $row['timestamp']);
        // }
        $result = mysqli_query($con, $query);
        if($result){
            // $resultData = array('status' => true, 'message' => 'Post Updated Successfully...');
            // $resultData['message']='Post Updated Successfully..';
            $msg="True";
            $resultData['message']=array($msg);
            $resultData['edit']=$arr;

        }else{
            $msg="False";
            $resultData['message'] = array($msg);
        }
    }
    else{
        $msg="False";
        $resultData['message'] = array($msg);
        // $resultData['message'] = 'Please enter post details...';
    }

    echo json_encode($resultData);
}

?>