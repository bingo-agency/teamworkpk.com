<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
include'../admin/includes/connection.php';
$msg = '';

if (isset($_GET['name']) && isset($_GET['email']) && isset($_GET['password']) && isset($_GET['phone'])) {

    $gotten_name = $_GET['name'];
    $gotten_email = $_GET['email'];
    $gotten_password = $_GET['password'];
    $gotten_phone = $_GET['phone'];
    $image = 'img/avatardefault.png';

    if (!filter_var($gotten_email, FILTER_VALIDATE_EMAIL)) {
        $msg = 'Invalied Email.';
        $respond["message"] = $msg;

//        exit();
    } else {




        $dup = mysqli_query($con, "SELECT `email` FROM `public_users` WHERE `email` = '" . $gotten_email . "'");
        if (mysqli_num_rows($dup) > 0) {
            // $db->error_front("This email address already exists, Try to <a href='login'>Login</a> to your account.");
            $msg = 'This email address already exist !';
        } else {
            if (empty($gotten_email) || empty($gotten_password) || empty($gotten_phone) || empty($gotten_name)) {
                $msg = "All fields are required!";
            } elseif (strlen($gotten_password) < 5) {
                $msg = "Your password should be at least 6 characters long.";
            } elseif (empty($gotten_phone)) {
                $msg = "Your Phone is required.";
            } else {
                $query = mysqli_query($con, "INSERT INTO `public_users` SET `email` = '" . $gotten_email . "', `password` = '" . $gotten_password . "', `name` = '" . $gotten_name . "', `image` = '" . $image . "',`phone` = '" . $gotten_phone . "'");
                if (!$query) {
//                                echo "INSERT INTO `users` SET `email` = '" . $email . "', `password` = '" . $password . "', `contact_name` = '" . $contact_name . "', `telephone` = '" . $telephone . "', `role` = '" . $role . "', `image` = '" . $image . "'";
                    $msg = "Your request can't be completed at the moment, please contact the admin support.";
                } else {
                    $msg = 'True';
                }
            }
        }
        $last_id = mysqli_insert_id($con).'';
        $respond['message'] = $msg;

        $respond['user'] = array('id' => $last_id, 'name' => $gotten_name, 'email' => $gotten_email, 'password' => $gotten_password, 'image' => 'https://teamworkpk.com/'.$image, 'phone' => $gotten_phone);
    }
} else {

    $respond["message"] = $False;
}
echo json_encode($respond);



// if(isset($_GET['id'])){
//     $id = $_GET['id'];
//   }
//   function getName ($con,$id){
//   $queryGet =mysqli_query($con,"SELECT * FROM `public_users` WHERE `id` = '".$id."'");
//   while($row = mysqli_fetch_array($queryGet,MYSQLI_ASSOC)){
//     return $name =$row['name'];
//   }
//   }
//   function getEmail ($con,$id){
//     $queryGet =mysqli_query($con,"SELECT * FROM `public_users` WHERE `id` = '".$id."'");
//     while($row = mysqli_fetch_array($queryGet,MYSQLI_ASSOC)){
//       return $email =$row['email'];
//     }
//   }
//   function getmePassword ($con,$id){
//     $queryGet =mysqli_query($con,"SELECT * FROM `public_users` WHERE `id` = '".$id."'");
//     while($row = mysqli_fetch_array($queryGet,MYSQLI_ASSOC)){
//       return $password =$row['password'];
//     }
// }
//     function getmeImage ($con,$id){
//         $queryGet =mysqli_query($con,"SELECT * FROM `public_users` WHERE `id` = '".$id."'");
//         while($row = mysqli_fetch_array($queryGet,MYSQLI_ASSOC)){
//           return $image =$row['image'];
//         }
//   }
//   function getmePhone ($con,$id){
//     $queryGet =mysqli_query($con,"SELECT * FROM `public_users` WHERE `id` = '".$id."'");
//     while($row = mysqli_fetch_array($queryGet,MYSQLI_ASSOC)){
//       return $phone =$row['phone'];
//     }
// }
// if(isset ($_GET['email'])){
//     $name = $_GET['name'];
//     $email = $_GET['email'];
//     $password = $_GET['password'];
//     // $role = $_GET['role'];
//     $image =$_GET['image'];
//     // $status = $_GET['status'];
//     $phone = $_GET['phone'];
//     // $timestamp = $_GET['timestamp'];
// $dup = mysqli_query($con, "SELECT `email` FROM `public_users` WHERE `email` = '" . $email . "'");
// if (mysqli_num_rows($dup) > 0) {
//     // $queryGet =mysqli_query($con,"SELECT * FROM `public_users` WHERE `id` = '".$id."'");
//     // while ($row = mysqli_fetch_array($dup, MYSQLI_ASSOC)) {
//     //     $id=$row['id'];
//     //     $name = $row['name'];
//     //     // $name = $row['name'];
//     //     $email = $row['email'];
//     //     $password = $row['password'];
//     //     // $role = $row['role'];
//     //     $image = 'img/avatar.svg'.$row['image'];
//     //     // $status = $row['status'];
//     //     $phone = $row['phone'];
//     //     // $timestamp = $row['timestamp'];
//     // }
//     $response ["message"]="user already exist";
//     echo json_encode($response);
//     // echo "user already exist";
// }
//     else{
//         $insert = "INSERT INTO `public_users` SET `email` = '" . $email . "', `password` = '" . $password . "', `name` = '" . $name . "', `image` = '" . $image . "',`phone` = '" . $phone . "'";
//         $result = mysqli_query($con,$insert) or die(mysqli_error($con));
//         if($result){
//             $respond["message"]="successfuly registered";
//         }
//         else{
//             $respond['message']="registration failed";
//         }
//         echo json_encode($respond);
//     }
// }
// else{
//     $respond["message"]="login failed";
// }
?>