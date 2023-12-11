<?php

session_start();

require_once 'admin/includes/connection.php';
require_once 'admin/includes/dataBase.php';


session_unset();
session_destroy();


$db->redirect("index");
?>