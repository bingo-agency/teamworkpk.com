<?php

include'../includes/connection.php';
ob_start();
include '../includes/dataBase.php';
session_start();


$email = $_GET['email'];
$message = $_GET['message'];

//$file = 'people.txt';
//// Open the file to get existing content
//$current = file_get_contents($file);
//// Append a new person to the file
//$current .= $email . '.' . $message;
//// Write the contents back to the file
//file_put_contents($file, $current);


$query = mysql_query("INSERT INTO `buy_standard` SET `email` = '" . $email . "', `message` = '" . $message . "', `ip` = '" . $db->getUserIP() . "'");
?>
