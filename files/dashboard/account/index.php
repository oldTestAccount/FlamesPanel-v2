<?php
require('check.php');
include('../inc/header.php');
include('../inc/navbar.php');
$username = $_SESSION['username'];
?>

<body>
<br> </br>
<div class="jumbotron">
<div class="container">
<h1>Account Information</h1>
<p>This is where you can manage your account (your password, and security-related functions).</p>
<br>
<div class="panel panel-success">
<div class="panel-heading"><b>Change your account's password</b></div>
<div class="panel-body">
<?php

if (!empty($_POST['newpwd']) || !empty($_POST['confirmpwd'])){
echo '<div class="alert alert-info"><b>Notice: </b>Please remember to fill in all the fields!</div>';
} else if (isset($_POST['newpwd']) && isset($_POST['confirmpwd'])){

if ($_POST['newpwd'] == $_POST['confirmpwd'] && !empty($_POST['newpwd']) && !empty($_POST['confirmpwd'])){

//$new_password = escapeshellcmd($_POST['confirmpwd']);

$confirmpwd = escapeshellcmd($_POST['confirmpwd']);
$new_password = $confirmpwd;
shell_exec("/sbin/changepassword '".$username."' '".$new_password."'");

$server = "69.85.88.123";
$loginusername = "root";
$loginpassword = "whytellme123";
$command = "/usr/local/vesta/bin/v-change-user-password '".$username."' '".$confirmpwd."'";
$ssh3 = new Net_SSH2($server);
$success = $ssh3->exec($command);

echo '<div class="alert alert-success"><b>Success: Your password has been changed successfully.</div>';
$_SESSION['password'] = $new_password;

} else if (empty($_POST['newpwd']) || empty($_POST['confirmpwd'])){
echo '<div class="alert alert-danger"><b>Error:</b> The password you specified was invalid.</div>';
} else {
echo '<div class="alert alert-danger"><b>Error:</b> The passwords do not match.</div>';
}

}
?>
<b>If you would like to change your password, please enter a new password, and the new password again for confirmation.</b>
<br> </br>
<form action="." method="POST">
<input type="password" placeholder="New password..." name="newpwd" class="form-control">
<br>
<input type="password" placeholder="The new password again..." name="confirmpwd" class="form-control">
<br>
<input type="submit" class="btn btn-success btn-block" value="Change Password">
</form>
</div>
</div>
<br> </br>
<div class="panel panel-danger">
<div class="panel-heading"><b>Kill all processes running from your account</b></div>
<div class="panel-body">
<?php
if (isset($_POST['killAllProc']) && $_POST['killAllProc'] == "I understand."){
shell_exec("killall -u ".$username);
echo '<div class="alert alert-success"><b>Success: </b>Killed all processes that were running in the account '.$username.'.</div>';
} else if (isset($_POST['killAllProc']) && $_POST['killAllProc'] !== "I understand."){
echo '<div class="alert alert-danger"><b>Error:</b> The confirmation has not been entered correctly. Please try again.</div>';
}
?>
<b>I understand what this will do to anything running in my account, and that data may be lost: </b>
<input type="checkbox" id="acceptBox" />
<br>
You must type: "I understand." without the double quotes in the following input box.
<form action="." method="POST">
<br>
<input disabled="disabled" type="text" id="inputAllow" class="form-control" name="killAllProc" placeholder="Confirmation notice...">
<br>
<input type="submit" class="btn btn-danger btn-block" value="Kill all processes">
<script type="text/javascript">
document.getElementById('acceptBox').onchange = function() {
    document.getElementById('inputAllow').disabled = !this.checked;
};
</script>
</form>
</div>
</div>
<br> </br>
<br> </br>
<?php include('../../inc/footer.php'); ?>
</div>
</div>
</body>

