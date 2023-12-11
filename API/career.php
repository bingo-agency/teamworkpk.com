<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
include'../admin/includes/connection.php';

$queryCareer = mysqli_query($con,"SELECT *FROM job_posts");
while($row=mysqli_fetch_array($queryCareer,MYSQLI_ASSOC)){
    $id=$row['id'];
    $title = $row['title'];
    $image = $row['image'];
    $description = $row['description'];
    $available_seats = $row['available_seats'];
    $city = $row['city'];
    $timestamp = $row['timestamp'];


    $arr[] = array('id'=>$id, 'title'=>$title, 'image'=>$image, 'description'=>$description, 'available_seats'=>$available_seats, 'city'=>$city, 'timestamp'=>$timestamp);

}
$response['careers']=$arr;
print json_encode($response);
?>