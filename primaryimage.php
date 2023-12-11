<?php

include'admin/includes/dataBase.php';

session_start();

print_r($_POST['primaryImage']);
if (!$_SESSION['public_user']) {
    $db->redirect('login');
}


if(isset($_POST['primaryImage'])) {
    $id = $_POST['primaryImage'];
    $prop_id = $_POST['propertyId'];
    $update_other_rows = "UPDATE `property_images` SET `primary_image` = '' WHERE `web_post_id` = $prop_id";
    $finaled_rows = mysqli_query($con, $update_other_rows);
    $update_primary_image = "UPDATE `property_images` SET `primary_image` = '1' WHERE `property_images`.`id` = '$id'";
    $finaled_query = mysqli_query($con,$update_primary_image);

    $select_primary_image_path = "SELECT `image_link` FROM `property_images` WHERE `id` = $id";
    $result = mysqli_query($con, $select_primary_image_path);
    $fetch_selected_path = mysqli_fetch_assoc($result);
    $fetched_image_link = $fetch_selected_path['image_link'];
    
    $update_web_primary_image = "UPDATE `web_posts` SET `primary_image` = '$fetched_image_link' WHERE `id` = $prop_id";
    $finaled_update_web_primary_image = mysqli_query($con, $update_web_primary_image);
    if(!$finaled_query) {
        echo $update_primary_image;   
    } else {
    echo "Your Query is working fine!!";
}
if(!$finaled_rows) {
    echo $finaled_rows;
} else {
    echo "Your Query is working fine!!";
}
}

?>
