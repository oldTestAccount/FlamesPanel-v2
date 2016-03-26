<?php
session_start();
if ($_SESSION['shadowing'] == "true"){
$_SESSION['username'] = "admin";
$_SESSION['shadowing'] = "false";
} else {
unset($_SESSION["username"]);
unset($_SESSION["password"]);
unset($_SESSION["logged_in"]);
}
    header("Location: https://cp.flameshost.com/");
?>

