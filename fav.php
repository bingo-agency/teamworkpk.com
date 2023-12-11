<?php 

include 'admin/includes/dataBase.php';

$favUserId = $_POST['favUserId'];
$favPostId = $_POST['favPostId'];


$checkUser = "SELECT * FROM `fav` WHERE `web_post_id` = '$favPostId' AND `public_user_id` = $favUserId";
$checkUserQuery = mysqli_query($con, $checkUser);
if(mysqli_num_rows($checkUserQuery) == 0 ) { 

$selectfav = "INSERT INTO `fav` (`web_post_id`, `public_user_id`) VALUES ('$favPostId', '$favUserId')";

$favSelectQuery = mysqli_query($con,$selectfav);

if($favSelectQuery) {
    echo "success";
}

} else {
    $deletefav = "DELETE FROM `fav` WHERE `web_post_id` = '$favPostId' AND `public_user_id` = $favUserId";
    $deletequery = mysqli_query($con, $deletefav);

    if($deletequery) {
        echo "Deleted";
    }
}

?>