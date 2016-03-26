<?php
require('check.php');
include('../inc/header.php');
include('../inc/navbar.php');
$username = $_SESSION['username'];

function generatePassword($length = 12) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}

if ($username != "admin" || $_SESSION['shadowing'] == "true"){
?>

<body>
<br> </br>
<div class="jumbotron">
<div class="container">
<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
<p>Welcome to FlamesPanel v2!</p>
<p>To get started, press the tabs above, and you'll be able to manage your account.</p>
<p><b>Disk Usage</b></p>
<?php
$disk=shell_exec("/bin/apache_finddisk ".$username);
$limit=shell_exec("/bin/apache_findlimit ".$username);
$diskpercent = $disk / $limit;
$getpercent = $diskpercent * 100;
$percentage2 = round($getpercent);
if ($percentage2 < 10){
$percentagebar = "10";
$percentage = $percentage2;
} else if ($percentage > 99){
$percentagebar = "100";
$percentage = "100";
} else {
$percentagebar = $percentage2;
$percentage = $percentage2;
}
?>
<div class="progress">
<?php if ($percentage > 90){ ?>
<div class="progress-bar progress-bar-striped progress-bar-danger active" role="progressbar" aria-valuenow="<?php echo $disk; ?>" aria-valuemin="0" aria-valuemax="<?php echo $limit; ?>" style="width: <?php echo $percentagebar; ?>%;">
<?php } else { ?>
<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $disk; ?>" aria-valuemin="0" aria-valuemax="<?php echo $limit; ?>" style="width: <?php echo $percentagebar; ?>%;">
<?php } ?>
<?php echo $disk; ?>MB used / <?php echo $percentage; ?>% used
</div>
</div>
<p>Here's a little bit of information:</p>
<pre><?php echo shell_exec('/bin/apache_help '.$username); ?></pre>
<br> </br>
<p><b>Want to upgrade?</b></p>
<a href="upgrade/" class="btn btn-block btn-success btn-lg">Learn more...</a>
<br> </br>
<?php include('../inc/footer.php'); ?>

</div>
</div>
</body>
<?php
} else if ($username == "admin"){
$u2 = $_POST['shadoweduser'];
$checkuser = shell_exec('/bin/checkuser '.$u2);
if (isset($_POST['shadoweduser']) && $checkuser == 1){
$_SESSION['username'] = $_POST['shadoweduser'];
$_SESSION['shadowing'] = "true";
$_SESSION['logged_in'] = "true";
echo '<meta http-equiv="refresh" content="0">';
} else if (isset($_POST['shadoweduser']) && $checkuser == 0){
echo '<meta http-equiv="refresh" content="0; url=https://cp.flameshost.com/dashboard/?shadowerror=1">';
}
?>
<body>
<br> </br>
<div class="jumbotron">
<div class="container">
<?php echo $check; ?>
<h1>Hello, Administrator :-) </h1>
<p>You have access to all functions, and the ability to add/remove invite/upgrade keys and users.</p>
<hr>
<p><b>Standard user output:</b></p>
<p>Welcome to FlamesPanel v2!</p>
<p>To get started, press the tabs above, and you'll be able to manage your account.</p>
<p>Here's a little bit of information:</p>
<pre><?php echo shell_exec('/bin/apache_help '.$username); ?></pre>
<hr>
<h3><b>Administrative Functions:</b></h3>
<p><b>Shadow a user</b></p>
<?php
if ($_GET['shadowerror'] == 1){
echo '<div class="alert alert-danger"><b>Error:</b> The user you entered was invalid, therefore you cannot shadow this user.</div>';
}
?>
<p>User List:</p>
<script type="text/javascript">
function showSpoiler(obj)
    {
    var inner = obj.parentNode.getElementsByTagName("div")[0];
    if (inner.style.display == "none")
        inner.style.display = "";
    else
        inner.style.display = "none";
    }
</script>
<div class="spoiler">
    <input type="button" name="btnShow" id="btnShow" class="btn btn-info btn-block btn-lg" onclick="showSpoiler(this);" value="Show/Hide User List" />
    <div class="inner" style="display:none;">
    <br>
<pre>
<?php echo shell_exec("grep '/home/' /etc/passwd | cut -d: -f1"); ?>
</pre>
    </div>
</div>
<br> 
<form method="POST" action=".">
<div class="input-group">
<input type="text" class="form-control" name="shadoweduser" placeholder="User to shadow...">
<span class="input-group-btn">
<input type="submit" class="btn btn-success" value="Shadow">
</span>
</div>
</form>
<br>
<p>Bandwidth Manager: <a href="https://cp.flameshost.com/bandwidth-manager" target="_blank">Launch</a> - please note you must access this from a approved IP address.</p>
<br>
<?php

if ($_GET['restart_apache'] == "do"){

shell_exec('bash /root/process-websites');

echo '<div class="alert alert-success"><b>Success:</b> Restarted Apache!</div>';          
}

if (isset($_POST['suspend_user'])){
$suspended = $_POST['suspend_user'];
shell_exec('/sbin/suspenduser '.$suspended);
echo '<div class="alert alert-success"><b>Success!</b> Suspended the user '.$suspended.'.</div>';
} 

if (isset($_POST['unsuspend_user'])){
$unsuspended = $_POST['unsuspend_user'];
shell_exec('/sbin/unsuspenduser '.$unsuspended);
echo '<div class="alert alert-success"><b>Success!</b> Unsuspended the user '.$unsuspended.'.</div>';
}

if (isset($_POST['add-invite-key'])){
$key = $_POST['add-invite-key'];
shell_exec('/bin/add_key '.$key);
echo '<div class="alert alert-success"><b>Success!</b> Added the invitation key to the database.</div>';
}
if (isset($_POST['remove-invite-key'])){
$key = $_POST['remove-invite-key'];
shell_exec('/bin/use-key '.$key);
echo '<div class="alert alert-success"><b>Success!</b> Removed the invitation key from the database.</div>';
}
if (isset($_POST['add-upgrade-key'])){
$key = $_POST['add-upgrade-key'];
shell_exec('/bin/add_upgrade_key '.$key);
echo '<div class="alert alert-success"><b>Success!</b> Added the upgrade key to the database.</div>';
}
if (isset($_POST['remove-upgrade-key'])){
$key = $_POST['remove-upgrade-key'];
shell_exec('/bin/use-upgrade-key '.$key);
echo '<div class="alert alert-success"><b>Success!</b> Removed the upgrade key from the database.</div>';
}
if (isset($_POST['create_user'])){
$userToCreate = $_POST['create_user'];
$passOfUser = generatePassword();
$createAcct = shell_exec('/sbin/www-createacct '.$userToCreate.' '.$passOfUser.' Created-By-Administrator');

if (strpos($createAcct, 'SUCCESS') !== false) {
echo '<div class="alert alert-success"><b>Success!</b> Created the user: '.$userToCreate.' with the password: '.$passOfUser.'!</div>';
} else {

echo '<div class="alert alert-warning"><b>Error:</b> The user: '.$userToCreate.' already exists.</div>';

}
}
?>
<p><b>Manipulate Invite/Upgrade Keys</b></p>
<pre>
<b>Invitation Keys:</b> 
<?php echo shell_exec('cat /invite-keys'); ?>

<b>Upgrade Keys:</b> 
<?php echo shell_exec('cat /upgrade-keys'); ?>
</pre>
<br>
<div class="well well-lg">
<h2><b>Administrative Functions</b></h2>
<h3>Suspended Users:</h3>
<pre><?php echo shell_exec('/bin/getsuspendedusers'); ?></pre>
<hr>
<h3>Suspend a user:</h3>
<form action="." method="POST">
<div class="input-group">
<input name="suspend_user" type="text" class="form-control" placeholder="Username...">
<span class="input-group-btn">
<input type="submit" class="btn btn-danger" value="Suspend User">
</span>
</div>
</form>
<br>
<h3>Un-suspend a user:</h3>
<form action="." method="POST">
<div class="input-group">
<input name="unsuspend_user" type="text" class="form-control" placeholder="Username...">
<span class="input-group-btn">
<input type="submit" class="btn btn-danger" value="Un-suspend User">
</span>
</div>
</form>
<br>
<h3>Create a user:</h3>
<form action="." method="POST">
<div class="input-group">
<input name="create_user" type="text" class="form-control" placeholder="Username...">
<span class="input-group-btn">
<input type="submit" class="btn btn-primary" value="Create User">
</span>
</div>
</form>
</div>

<a href="/dashboard/?restart_apache=do" class="btn btn-danger btn-block btn-lg">Process Pending VirtualHosts</a>

<br> </br>
<!--<p><b>Want to upgrade?</b></p>
<a disabled="disabled" href="#" class="btn btn-block btn-success btn-lg">Learn more...</a>-->
<br> </br>
<?php include('../inc/footer.php'); ?>

</div>
</div>
</body>

<?php
}
?>

