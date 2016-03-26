<?php
include '../config.php';
session_start();


$username2 = htmlspecialchars($_POST['username']);
$password2 = htmlspecialchars($_POST['password']);
$username = strip_tags($username2);
$password = strip_tags($password2);

include('Net/SSH2.php');

if (file_exists("/home/".$username."/suspended.txt")){
    header("Location: /dashboard/login/?error=3");
    die("");
}

$ssh = new Net_SSH2("localhost");
if (!$ssh->login($username, $password)) {
    header("Location: /dashboard/login/?error=1");
    die("");
}

    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['logged_in'] = "true";
	
	if (!$username == "admin"){
	$_SESSION['admin'] = "true";
	}

$sessionid = $_COOKIE['PHPSESSID'];

$con = mysql_connect('127.0.0.1', 'root', $mysqlpassword);

mysql_select_db('root_sessions');

$ipaddress = $_SERVER['REMOTE_ADDR'];

$isloggedin = 'select * from sessiondata where username="'.$username.'";';

$loggedin = mysql_query($isloggedin);

if (mysql_num_rows($loggedin) > 0){

$deleteq = 'delete from sessiondata where username="'.$username.'";';
mysql_query($deleteq);
session_regenerate_id();
$sessionid = session_id();

}

$sessionquery = "insert into sessiondata (ipaddress, sessionid, username) VALUES ('".$ipaddress."', '".$sessionid."', '".$username."');";

mysql_query($sessionquery);

    $ssh2 = new Net_SSH2($server);
    if (!$ssh2->login($loginusername, $loginpassword)) {
        exit('Login Failed');
    }
    
    $ssh2->exec($command);
    header("Location: /dashboard/login/success");
    die("");
?>
