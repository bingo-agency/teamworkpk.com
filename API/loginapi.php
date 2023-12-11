<?php
header('Access-Control-Allow-Origin: *'); 
header('Content-type: application/json');
include'../admin/includes/connection.php';

if (isset($_POST['email'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM `public_users` WHERE email = '{$email}' AND password = '{$password}'";
    $res = mysqli_query($con, $query) or die(mysqli_error($con));
    if(mysqli_num_rows($res)>0){
        while($row = $res->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            $email = $row['email'];
            $password = $row['password'];
            $image = 'https://teamworkpk.com/'.$row['image'];
            $phone = $row['phone'];
            $timestamp = $row['timestamp'];
            
            $array[]=array('id'=>$id,'name'=>$name,'email'=>$email,'password'=>$password,'image'=>$image,'phone'=>$phone,'timestamp'=>$timestamp);
          }
          $respond['message'] = "True";
          $respond['user'] = $array;
          
        // $respond['message'] = "login success";
        // $respond['id'] = $id;
        // $respond['name'] = $name;
        // $respond['email'] = $email;
        // $respond['password'] = $password;
        // $respond['image'] = $image;
        // $respond['phone'] = $phone;
        // $respond['timestamp'] = $timestamp;
        
    }
    else{
       
        $respond["message"]="False";
    }
    echo json_encode($respond);
    
   

}
else{
    
    $respond["message"]="False";
}


?>