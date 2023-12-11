<?php
header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
include'../admin/includes/connection.php';

$results_per_page = 20;
$final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page }";
$query = mysqli_query($con, $final_query);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $id = $row['id'];
    $internal_id = $row['internal_lead_id'];
    $title = $row['title'];
    $desc = $row['description'];
    $price = $row['price'];
    $address = $row['address'];
    $city = $row['city'];
    $views = $row['views'];
    $type = $row['type'];
    $property_type = $row['property_type'];
    $purpose = $row['purpose'];
    $land_area = $row['land_area'];
    $year_build = $row['year_build'];
    $primary_image = 'https://teamworkpk.com/'.$row['primary_image'];
    $floor_plans = $row['floor_plans'];
    $public_id = $row['public_user_id'];
    $comments = $row['comments'];
    $video_link = $row['video_link'];
    $verification_status = $row['verification_status'];
    $featured = $row['featured'];
    $timestamp = $row['timestamp'];
    $property_images_arr = array();
    
    $queryGetGallery = mysqli_query($con, "SELECT * FROM `property_images` WHERE `web_post_id` = '" . $id . "'");
        while ($rowGallery = mysqli_fetch_array($queryGetGallery, MYSQLI_ASSOC)) {
            $property_images_arr[] = array('id' => $rowGallery['id'], 'web_post_id' => $rowGallery['web_post_id'], 'image_link' => 'https://teamworkpk.com/' . $rowGallery['image_link'], 'timestamp' => $rowGallery['timestamp']);
        }

    $arr[] = array('id' => $id, 'internal_lead_id' => $internal_id,'title'=>$title,'description' => $desc, 'price'=>$price, 'address'=>$address, 'city'=>$city, 'views'=>$views, 'type'=>$type, 'property_type'=>$property_type, 'purpose'=>$purpose, 'land_area'=>$land_area, 'year_build'=>$year_build, 'primary_image'=>$primary_image,'property_images'=>$property_images_arr, 'floor_plans'=>$floor_plans, 'public_user_id'=>$public_id, 'comments'=>$comments, 'video_link'=>$video_link, 'verification_status'=>$verification_status, 'featured'=>$featured, 'timestamp'=>$timestamp,'msg'=>'True');
    // $arr[] = array('featured' => $gotten_featured, 'property_type' => $gotten_property_type,'type'=>$gotten_type,'city_search' => $gotten_city_search, 'keyword'=>$gotten_keyword);
    // $response ['nonfeatured'] = $arr;
    // print json_encode($response);
}

// check if results>0 else object-> msg 'no results found.'
$res = mysqli_query($con, $final_query);
if(mysqli_num_rows($res)>0){
            $response ['home'] = $arr;
            // $response ['nonfeatured'] = $arr;
}
else{
    $arr[] = array('msg' => 'no records found, try city search.', );
    $response ['home'] = $arr;
}
            print json_encode($response);
?>