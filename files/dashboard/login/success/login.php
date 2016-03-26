<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
include('Net/SSH2.php');
$ssh = new Net_SSH2("localhost");
if (!$ssh->login($username, $password)) {
    echo "<meta http-equiv='refresh' content='0;url=http://cp.flameshost.com/dashboard/login/?error=1'>";
    die("");
}

    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['logged_in'] = "true";
    echo "<meta http-equiv='refresh' content='0;url=http://cp.flameshost.com/dashboard/login/success'>";
    die("");
?>
