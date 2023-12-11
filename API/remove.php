<?php

header("Content-Type: application/json"); 
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Mehtods: DELETE");
include'../admin/includes/connection.php';


if (isset($_GET['id'])) {
    $web_post_id=$_GET['id'];

//Check student record exist or not if exists then we delete 
$sql1="SELECT * FROM web_posts WHERE id={$web_post_id}";
$result1=mysqli_query($con,$sql1) or die("SQL Query Failed: Check record");

if(mysqli_num_rows($result1) > 0){
	$sql="DELETE FROM web_posts WHERE id={$web_post_id} ";

	 if(mysqli_query($con,$sql)){
	 	// echo json_encode(array("message"=> " Record Deleted","status"=> TRUE));
		 $msg="True"; 
		 $resultData['remove']=array($msg);
		}else{
		$msg="False";
		$resultData['remove']=array($msg);
		// echo json_encode(array("message"=> " Record Can't Deleted","status"=> FALSE));
	}

}else{
	$msg="False";
	$resultData['remove']=array($msg);
	// echo json_encode(array("message"=> " Record does not exist","status"=> FALSE));
}
echo json_encode($resultData);
}
?>