<?php
require('check.php');
$username = $_SESSION['username'];
if ($username !== "admin"){
?>
<!-- FlamesPanel v2 B0.01 [] (c) Andrew Hong. 2016 -->
<?php
die();
}

include('../inc/header.php');
include('../inc/navbar.php');
?>

<body>
<br> </br>
<div class="jumbotron">
<div class="container">
<h1>Manage FlamesPanel</h1>
<p>This is where you can manage FlamesPanel's features, as well as your users, etc.</p>
<?php
if (!empty($_POST['create-user']) && !empty($_POST['create-pass'])){
$user_create = $_POST['create-user'];
$user_pass = $_POST['create-pass'];
$out = shell_exec('/sbin/www-createacct '.$user_create.' '.$user_pass.' user-created-by-admin default@changeme.com');
if (strpos($out, 'Error') !== false) {
echo '<br />';
echo '<div class="alert alert-danger"><b>Error:</b> The user '.$user_create.' has not been created. Press <a href="/dashboard/admin">here</a> to go back.</div>';
echo '<br><b>Debug:</b><p></p>';
echo '<pre>'.$out.'</pre>';
die();
} else {
echo '<br />';
echo '<div class="alert alert-success"><b>Success!</b> The user '.$user_create.' has been created successfully. Press <a href="/dashboard/admin">here</a> to go back.</div>';
echo '<br><b>Debug:</b><p></p>';
echo '<pre>'.$out.'</pre>';
die();
}
}

if (!empty($_POST['delete-user'])){

$del_user = $_POST['delete-user'];
$out = shell_exec('/sbin/killacct '.$del_user.' y');
echo '<br />';
echo '<div class="alert alert-success"><b>Success!</b> The user '.$del_user.' has been terminated successfully. Press <a href="/dashboard/admin">here</a> to go back.</div>';
echo '<br><b>Debug:</b><p></p>';
echo '<pre>'.$out.'</pre>';
die();

}

if (!empty($_POST['changepass-user']) && !empty($_POST['changepass-pass'])){

$changepassuser = $_POST['changepass-user'];
$changepasspass = $_POST['changepass-pass'];
$out = shell_exec('/sbin/changepassword '.$changepassuser.' '.$changepasspass);
echo '<br />';
echo '<div class="alert alert-success"><b>Success!</b> The password for '.$changepassuser.' has been changed successfully. Press <a href="/dashboard/admin">here</a> to go back.</div>';
echo '<br><b>Debug:</b><p></p>';
echo '<pre>'.$out.'</pre>';
die();

}

?>
<br />
<h2><b>Manage users</b></h2>
<h3>Create user</h3>
<br />
<form action="." method="POST">
<input autocomplete="off" class="form-control" type="text" name="create-user" placeholder="Username...">
<br>
<div class="input-group">
<input autocomplete="off" class="form-control" type="password" name="create-pass" placeholder="Password...">
<span class="input-group-btn">
<input class="btn btn-success" type="submit" value="Create user">
</span>
</div>
</form>
<hr>
<h3>Terminate user</h3>
<form action="." method="POST">
<div class="input-group">
<input autocomplete="off" class="form-control" type="text" name="delete-user" placeholder="Username...">
<span class="input-group-btn">
<input class="btn btn-danger" type="submit" value="Terminate user">
</span>
</div>
</form>
<hr>
<h3>Change password of user</h3>
<form action="." method="POST">
<input autocomplete="off" class="form-control" type="text" name="changepass-user" placeholder="Username...">
<br>
<div class="input-group">
<input autocomplete="off" class="form-control" type="password" name="changepass-pass" placeholder="New password...">
<span class="input-group-btn">
<input class="btn btn-primary" type="submit" value="Change password">
</span>
</div>
</form>
<br> </br>
<?php include('../../inc/footer.php'); ?>
</div>
</div>
</body>

