<?php

include'../includes/connection.php';
ob_start();
include '../includes/dataBase.php';
session_start();


$email = $_GET['email'];
$name = $_GET['name'];
$model = $_GET['model'];
$qty = $_GET['qty'];
$condition = $_GET['condition'];
$warranty = $_GET['warranty'];
$budget = $_GET['budget'];


$file = 'people.txt';
// Open the file to get existing content
$current = file_get_contents($file);
// Append a new person to the file
$current .= $name . ' && ' . $email . ' && ' . $qty . ' && ' . $model . ' && ' . $condition . ' && ' . $warranty . ' && ' . $budget . ' && <br />' . $db->getUserIp();
// Write the contents back to the file
file_put_contents($file, $current);


$query = mysql_query("INSERT INTO `buy_advanced` SET `name` = '" . $name . "', `email` = '" . $email . "', `model` = '" . $model . "', `qty` = '" . $qty . "', `condition` = '" . $condition . "', `warranty` = '" . $warranty . "', `budget` = '" . $budget . "', `ip` = '" . $db->getUserIp() . "' ");
?>
