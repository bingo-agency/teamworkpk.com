<?php
ob_start();
include 'includes/dataBase.php';
session_start();
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo $actual_link; // Outputs: URI
//if ($actual_link == "/https://portal.myproject100.com/" || $actual_link == "http://portal.myproject100.com/") {
//    $db->redirect('https://myproject100.com/portal/');
//}
$db->redirect('login');
?>
