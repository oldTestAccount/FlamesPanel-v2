<?php
require('check.php');
include('../inc/header.php');
include('../inc/navbar.php');
$username = $_SESSION['username'];
function clean($string) {

   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}
?>

<script type="text/javascript">
var windowObjectReference;
var strWindowFeatures = "menubar=no,location=no,resizable=no,scrollbars=yes,status=no,height=800px,width=1000px";

function openRequestedPopup() {
  windowObjectReference = window.open("/dashboard/manage-mysql/phpmyadmin.php", "FlamesPanel phpMyAdmin Login", strWindowFeatures);
}
</script>

<body>
<br> </br>
<div class="jumbotron">
<div class="container">
<h1>Manage MySQL databases</h1>
<p>This is where you can view your MySQL databases and create them, too.</p>
<p>If this is your first time, or you forgot your MySQL password, please set your password below (please note, all special characters are stripped, please use a alphanumeric password, and change it later in phpMyAdmin).</p>
<hr>
<?php
if (isset($_POST['newsqlpwd'])){
$password1 = htmlspecialchars($_POST['newsqlpwd']);
$password2 = clean($password1);
$password = escapeshellcmd($password2);
$out = shell_exec('/sbin/change_mysql_password '.$username.' '.$password);
?>
<div class="alert alert-success"><b>Success! </b>MySQL Password changed; output from server:</div>
<pre><?php echo $out; ?></pre>
<?php
}
?>
<form action="." method="POST">
<div class="input-group">
<input type="password" name="newsqlpwd" class="form-control" placeholder="New MySQL password (special characters are stripped, plaintext only -- change after logging in to phpMyAdmin.)" />
<span class="input-group-btn">
<input type="submit" class="btn btn-success" value="Change MySQL Password" />
</span>
</div>
</form>
<br>
</span>
</div>
</form>

<div class="container">
<div class="well well-lg">
<h2>Launch phpMyAdmin</h2>
<br>
<a onclick="openRequestedPopup();" class="btn btn-success btn-lg btn-block">Launch phpMyAdmin</a>
</div>
</div>
</div>
<br>
<?php include('../../inc/footer.php'); ?>
</div>
</div>
</body>

