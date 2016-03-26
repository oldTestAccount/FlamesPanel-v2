<?php
include_once('../../inc/header.php');
include_once('../../inc/navbar.php');
// require('../../inc/auth.php');
?>

<br> </br>

<div class="jumbotron">
<div class="container">
<h1>Log In</h1>
<br>
<?php
if ($_GET['error'] == "1"){
?>
<div class="alert alert-danger"><b>Error:</b> Login failed.</div>
<?php
}
?>
<meta http-equiv="refresh" content="2; url=https://cp.flameshost.com/dashboard">
<div class="alert alert-success"><b>Login successful!</b> Redirecting...</div>
<form action="" method="POST">
<input type="text" class="form-control" disabled="disabled" required="required" name="username" placeholder="My username..." />
<br>
<input type="password" class="form-control" disabled="disabled" required="required" name="password" placeholder="My password..." />
<br>
<input type="submit" value="Login successful!" disabled="disabled" class="btn btn-success btn-lg">
</form>
