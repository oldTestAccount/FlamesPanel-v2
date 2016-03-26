<?php
session_start();
$username = $_SESSION['username'];

include 'config.php';

$sessionid = $_COOKIE['PHPSESSID'];
$conn = mysql_query('127.0.0.1', 'root', $mysqlpassword);
mysql_select_db('root_sessions');
$ipaddress = $_SERVER['REMOTE_ADDR'];
//$checkquery = "select * from sessiondata where ipaddress='".$ipaddress."' and sessionid='".$sessionid."' and username='".$username."';";
//$resultsofquery = mysql_query($checkquery);

//$IsIPCorrectQuery = 'select * from sessiondata where username="'.$username.'" and ipaddress="'.$ipaddress.'";';
//$IsIPCorrect = mysql_query($IsIPCorrectQuery);

include('isipvalid.php');

if ($status == "INVALID"){
header("Location: /dashboard/log_out");
}

/*
if (mysql_num_rows($IsIPCorrect) == "0"){
header("Location: /dashboard/log_out");
}

if (mysql_num_rows($resultsofquery) == "0"){
header("Location: /dashboard/log_out");

}
*/

$password = $_SESSION['password'];
include('Net/SSH2.php');
$ssh = new Net_SSH2("localhost");
if (!$ssh->login($username, $password)) {
    header("Location: /dashboard/login/?error=1");
    die("You should have been redirected.");
}
    $_SESSION['logged_in'] = "true";
?>

