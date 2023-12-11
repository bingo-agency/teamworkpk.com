<?php
header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
include'../admin/includes/connection.php';

$queryGetProperties = mysqli_query($con, "SELECT * FROM `projects`");
            while ($row = mysqli_fetch_array($queryGetProperties, MYSQLI_ASSOC)) {
                $id = $row['id'];
                $title = $row['title'];
                $ribbon = $row['ribbon'];
                $des = $row['description'];
                $image_link = 'https://teamworkpk.com/admin/'.$row['image_link'];
                $address = $row['address'];
                $city = $row['city'];
                $video_link = $row['video_link'];
                $type = $row['type'];
                $views = $row['views'];
                $price = $row['price'];
                $year_build = $row['year_build'];
                $timestamp = $row['timestamp'];
                $arr[] = array('id' => $id, 'title' => $title, 'ribbon'=>$ribbon, 'description' => $des, 'price'=>$price, 'address'=>$address, 'city'=>$city, 'views'=>$views, 'type'=>$type, 'year_build'=>$year_build, 'image_link'=>$image_link,'video_link'=>$video_link, 'timestamp'=>$timestamp);
            }
            $response['projects'] = $arr;
            print json_encode($response);

?>