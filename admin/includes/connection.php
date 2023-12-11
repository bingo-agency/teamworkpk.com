<?php




$db_host = "localhost";
$db_user = "teamwogp_teamwork";
$db_pass = '11235813teamwork';
$db_name = "teamwogp_teamwork";
 

/*
  $db_host = "localhost";
  $db_user = "root";
  $db_pass = "";
  $db_name = "teamwork";
*/
//  $con = $GLOBALS['connection'];
$GLOBALS['con'] = ($GLOBALS["___mysqli_ston"] = mysqli_connect($db_host, $db_user, $db_pass)) or die("Problem occur in connection");
$db = ((bool) mysqli_query($con, "USE " . $db_name));


ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);
