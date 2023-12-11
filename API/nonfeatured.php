<?php
header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
include'../admin/includes/connection.php';

$results_per_page = 4000;
$final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page }";


if (isset($_GET['feature'])) {
    $gotten_featured = $_GET['feature'];
    if ($gotten_featured == 'yes') {
        $final_query = "SELECT * FROM `web_posts` WHERE `featured` = '1' AND `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page}";
    }
}
if (isset($_GET['property_type'])) {
    $gotten_property_type = $_GET['property_type'];
    if ($gotten_property_type != '') {
        $final_query = "SELECT * FROM `web_posts` WHERE `property_type` = '" . $gotten_property_type . "' AND `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page}";
    } else {
        $final_query = "SELECT * FROM `web_posts` WHERE  `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page} ";
    }
}
if (isset($_GET['type'])) {
    $gotten_type = $_GET['type'];
    if ($gotten_type != '') {
        $final_query = "SELECT * FROM `web_posts` WHERE `type` = '" . $gotten_type . "' AND `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page}";
    } else {
        $final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page} ";
    }
}

if (isset($_GET['city_search'])) {
    $gotten_city_search = $_GET['city_search'];
    if (empty($gotten_city_search)) {
        $final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page}";
    } else {
        $final_query = "SELECT * FROM `web_posts` WHERE `city` = '" . $gotten_city_search . "' AND `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page} ";
    }
}

if (isset($_GET['keyword'])) {
    $gotten_keyword = $_GET['keyword'];
    $final_query = "SELECT * FROM `web_posts` WHERE (`title` LIKE '%" . $gotten_keyword . "%') OR (`internal_lead_id` LIKE '%" . $gotten_keyword . "%') AND `verification_status` = 1";
}


if (isset($_GET['advance_search'])) {
    $gotten_city = $_GET['city'];
    $gotten_keyword = $_GET['keyword'];
    $gotten_type = $_GET['type'];

    if (empty($gotten_keyword) || empty($gotten_city) || empty($gotten_type)) {
        $final_query = "SELECT * FROM `web_posts` WHERE `verification_status` = '1' ORDER BY `id` DESC LIMIT {$results_per_page}";
    }
    if (empty($gotten_city) && empty($gotten_type)) {
        $db->redirect('listing?keyword=' . $gotten_keyword);
    }
    if (empty($gotten_keyword) && empty($gotten_type)) {
        $db->redirect('listing?city_search=' . $gotten_city);
        exit();
    }
    if (empty($gotten_keyword) && empty($gotten_city)) {
        $db->redirect('listing?type=' . $gotten_type);
        exit();
    }
    if (!empty($gotten_keyword) && !empty($gotten_city) && !empty($gotten_type)) {
        $final_query = "SELECT * FROM `web_posts` WHERE (`title` LIKE '%" . $gotten_keyword . "%') AND (`internal_lead_id` LIKE '%" . $gotten_keyword . "%')  AND `type` = '" . $gotten_type . "' AND `city` = '" . $gotten_city . "' ORDER BY `id` DESC LIMIT {$results_per_page}";
        
    }
}
$Count_query = mysqli_query($con, $final_query);
$recordsNow = mysqli_num_rows($Count_query);
$query = mysqli_query($con, $final_query);
// echo $final_query;
// exit();

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
            $response ['nonfeatured'] = $arr;
            // $response ['nonfeatured'] = $arr;
}
else{
    $arr[] = array('msg' => 'no records found, try city search.', );
    $response ['nonfeatured'] = $arr;
}
            print json_encode($response);

?>