<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
include'../admin/includes/connection.php';

if (isset($_GET['public_user_id']) && (isset($_GET['selected']))) {
    $public_user_id = $_GET['public_user_id'];
    $selected = $_GET['selected'];
//    $property_images_arr = array();

    switch ($selected) {
        case 'profile' :
            $newquery = mysqli_query($con, "SELECT * FROM `public_users` WHERE `id` = '" . $public_user_id . "'ORDER by `id` DESC");
            while ($newrow = mysqli_fetch_array($newquery, MYSQLI_ASSOC)) {
                $arr[] = array('id' => $newrow['id'], 'name' => $newrow['name'], 'email' => $newrow['email'], 'password' => $newrow['password'], 'image' => $newrow['image'], 'phone' => $newrow['phone'], 'timestamp' => $newrow['timestamp']);
            }

            break;
        case 'ads' :
            $query = mysqli_query($con, "SELECT * FROM `web_posts` WHERE `public_user_id` = '" . $public_user_id . "' ORDER by `id` DESC");
            if (mysqli_num_rows($query) > 0) {




//                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
//                    $id = $row['id'];
//                    $internal_id = $row['internal_lead_id'];
//                    $title = $row['title'];
//                    $desc = $row['description'];
//                    $price = $row['price'];
//                    $address = $row['address'];
//                    $city = $row['city'];
//                    $views = $row['views'];
//                    $type = $row['type'];
//                    $property_type = $row['property_type'];
//                    $purpose = $row['purpose'];
//                    $land_area = $row['land_area'];
//                    $year_build = $row['year_build'];
//                    $primary_image = 'https://teamworkpk.com/' . $row['primary_image'];
//                    $floor_plans = $row['floor_plans'];
//                    $public_id = $row['public_user_id'];
//                    $comments = $row['comments'];
//                    $video_link = $row['video_link'];
//                    $verification_status = $row['verification_status'];
//                    $featured = $row['featured'];
//                    $timestamp = $row['timestamp'];
//                    $property_images_arr = array();
//
//                    $queryGetGallery = mysqli_query($con, "SELECT * FROM `property_images` WHERE `web_post_id` = '" . $id . "'");
//                    while ($rowGallery = mysqli_fetch_array($queryGetGallery, MYSQLI_ASSOC)) {
//                        $property_images_arr[] = array(
//                            'id' => $rowGallery['id'],
//                            'web_post_id' => $rowGallery['web_post_id'],
//                            'image_link' => 'https://teamworkpk.com/' . $rowGallery['image_link'],
//                            'timestamp' => $rowGallery['timestamp']);
//                    }
//
//                    $arr[] = array(
//                        'id' => $id,
//                        'internal_lead_id' => $internal_id,
//                        'title' => $title,
//                        'description' => $desc,
//                        'price' => $price,
//                        'address' => $address,
//                        'city' => $city,
//                        'views' => $views,
//                        'type' => $type,
//                        'property_type' => $property_type,
//                        'purpose' => $purpose,
//                        'land_area' => $land_area,
//                        'year_build' => $year_build,
//                        'primary_image' => $primary_image,
//                        'property_images' => $property_images_arr,
//                        'floor_plans' => $floor_plans,
//                        'public_user_id' => $public_id,
//                        'comments' => $comments,
//                        'video_link' => $video_link,
//                        'verification_status' => $verification_status,
//                        'featured' => $featured,
//                        'timestamp' => $timestamp,
//                        'msg' => 'True');
//
//
//                    // $arr[] = array('featured' => $gotten_featured, 'property_type' => $gotten_property_type,'type'=>$gotten_type,'city_search' => $gotten_city_search, 'keyword'=>$gotten_keyword);
//                    // $response ['nonfeatured'] = $arr;
//                    // print json_encode($response);
//                }





                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                    $queryGetGallery = mysqli_query($con, "SELECT * FROM `property_images` WHERE `web_post_id` = '" . $row['id'] . "'");
//                    echo mysqli_num_rows($queryGetGallery);
//                    exit();
                    if (mysqli_num_rows($queryGetGallery) > 0) {
                        while ($rowGallery = mysqli_fetch_array($queryGetGallery)) {
                            $property_images_arr[] = array(
                                'id' => $rowGallery['id'],
                                'web_post_id' => $rowGallery['web_post_id'],
                                'image_link' => 'https://teamworkpk.com/' . $rowGallery['image_link'],
                                'timestamp' => $rowGallery['timestamp']);
                        }
                    } else {
                        $property_images_arr[] = array('msg' => 'No Gallery Photos');
                    }

                    $arr[] = array(
                        'id' => $row['id'],
                        'internal_lead_id' => $row['internal_lead_id'],
                        'title' => $row['title'],
                        'description' => $row['description'],
                        'price' => $row['price'],
                        'address' => $row['address'],
                        'city' => $row['city'],
                        'views' => $row['views'],
                        'type' => $row['type'],
                        'property_type' => $row['property_type'],
                        'purpose' => $row['purpose'],
                        'land_area' => $row['land_area'],
                        'year_build' => $row['year_build'],
                        'primary_image' => 'https://teamworkpk.com/' . $row['primary_image'],
                        'property_images' => $property_images_arr,
                        'floor_plans' => $row['floor_plans'],
                        'public_user_id' => $row['public_user_id'],
                        'comments' => $row['comments'],
                        'video_link' => $row['video_link'],
                        'verification_status' => $row['verification_status'],
                        'featured' => $row['featured'],
                        'timestamp' => $row['timestamp'], 'message' => 'True');
                }
            } else {
                $arr[] = array('message' => 'No Records Found.');
                $respond ['account'] = $arr;
//                print json_encode($respond);
            }

            break;
        case 'fav' :
            $query = mysqli_query($con, "SELECT * FROM `fav` WHERE `public_user_id` = '" . $id . "'ORDER by `id` DESC");
            while ($favrow = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $arr[] = array('id' => $favrow['id'], 'web_post_id' => $favrow['web_post_id'], 'public_user_id' => $favrow['public_user_id'], 'timestamp' => $favrow['timestamp']);
            }
            break;
        default :
        case 'profile':
            break;
    }
    if (mysqli_num_rows($query) > 0) {
        $response ['account'] = $arr;

        $respond ['account'] = $arr;
//        print json_encode($respond);
    }
} else {
    $arr[] = array('msg' => 'no records found',);
    $respond ['account'] = $arr;
//    print json_encode($respond);
}
print json_encode($respond);
?>