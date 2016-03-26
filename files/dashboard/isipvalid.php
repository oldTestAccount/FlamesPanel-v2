<?php
include 'config.php';
session_start();
$username = $_SESSION['username'];
$conn = mysql_connect("127.0.0.1", "root", $mysqlpassword);
mysql_select_db("root_sessions");
$sessionquery = "select ipaddress from sessiondata where username='$username';";
$sessionresults = mysql_query($sessionquery);
$ipaddress = $_SERVER['REMOTE_ADDR'];

   while ($row = mysql_fetch_array($sessionresults)) {
        $ipfromdb = $row['ipaddress'];
    }

if ($ipfromdb !== $ipaddress){
$status = "INVALID";
} else {
$status = "VALID";
}
?>
