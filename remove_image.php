<?php

include'admin/includes/dataBase.php';

session_start();

if (!$_SESSION['public_user']) {
    $db->redirect('login');
}
if (isset($_GET['remove_id'])) {
    $id = $_GET['remove_id'];

    $query_remove_image = mysqli_query($con, "DELETE FROM `property_images` WHERE `id` = '" . $id . "'");
    if ($query_remove_image) {
        echo 'cool';
    }
}