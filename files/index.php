<?php 
include ('inc/header.php'); 
if (!empty($_SESSION['username'])){
header("Location: https://cp.flameshost.com/dashboard");
}
include ('inc/navbar.php');
?>
<!DOCTYPE html>
<style type="text/css"> 
html { 
background: url('data:image/jpeg;base64,') no-repeat center center fixed; 
-webkit-background-size: cover; 
-moz-background-size: cover; 
-o-background-size: cover; 
background-size: cover;
} 
</style>
<body> 
<br> </br> 
<div class="jumbotron"> 
<div class="container"> 
<h1>Welcome to FlamesPanel v2!</h1> 
<p>Click login to manage your account.</p>
</body>
