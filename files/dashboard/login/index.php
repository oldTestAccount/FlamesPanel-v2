<?php
include_once('../../inc/header.php');
include_once('../../inc/navbar.php');
// require('../../inc/auth.php');
if($_SERVER['HTTPS']!="on"){
echo '<meta http-equiv="refresh" content="0; url=/dashboard/login">';
}

//$username = $_SESSION['username'];
//if (!empty($username)){
//echo '<meta http-equiv="refresh" content="0; url=/dashboard/log_out">';
//}
?>

<br> </br>

<script src="style.js"></script>
<link href="style.css" rel="stylesheet" type="text/css">

<div class="jumbotron">
<div class="container">
<h1>Log In</h1>
<br>
<?php
if ($_GET['error'] == "1"){
?>
<div class="alert alert-danger"><b>Error:</b> Login failed.</div>
<?php
} else if ($_GET['error'] == "2"){
?>
<div class="alert alert-danger"><b>Error:</b> You have previously registered.</div>
<?php
} else if ($_GET['error'] == "3"){
?>
<div class="alert alert-danger"><b>Error:</b> Account suspended! Please contact support.</div>
<?php
} else if ($_GET['error'] == "4"){
?>
<div class="alert alert-danger"><b>Error:</b> Your session was invalid. Please log in again.</div>
<?php
}
?>
<form id="loginForm" action="login.php" method="POST" onsubmit="loading();">
<input type="text" class="form-control" required="required" name="username" placeholder="My username..." />
<br>
<input type="password" class="form-control" required="required" name="password" placeholder="My password..." />
<br>
<button id="activateBtn" onclick="loading()" type="submit" form="loginForm" value="Login" class="btn btn-success" style="float:right;">Login</button>
</form>
