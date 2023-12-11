<?php

session_start();

require_once 'includes/connection.php';
require_once 'includes/dataBase.php';


session_unset();
session_destroy();


$db->redirect("index");
?>