<?php

ob_start();
include '../includes/dataBase.php';
session_start();


$user_id = $db->getSession_id();
$text = mysql_real_escape_string($_POST['text']);
$messages_id = mysql_real_escape_string($_POST['messages_id']);


$query = mysql_query("INSERT INTO `messages_replies` SET `message` = '" . $text . "', `user_id` = '" . $user_id . "', `messages_id` = '" . $messages_id . "', `status` = 'unread'");
if (!$query) {
    $db->error("Please try again later");
} else {
    $db->error("Been posted.");
    $queryUpdateMain = mysql_query("UPDATE `messages` SET `message` = '" . $text . "', `status` = 'unread' WHERE `id` = '" . $messages_id . "'");
}