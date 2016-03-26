<?php
include('../inc/header.php');
//include('../inc/navbar.php');
require('check.php');
$username = $_SESSION['username'];
?>

<?php
if (isset($_POST['pma_password'])){

$pma_password = $_POST['pma_password'];
$conn = new mysqli("127.0.0.1", $username, $pma_password);
if ($conn->connect_error) {
    header("Location: /dashboard/manage-mysql/phpmyadmin.php?err=1");
    echo '<meta http-equiv="refresh" content="0; url=/dashboard/manage-mysql/phpmyadmin.php?err=1">';
    die();
}
?>
<meta http-equiv="refresh" content="4; url=/phpmyadmin/index.php?pma_username=<?php echo $_POST['pma_username']; ?>&pma_password=<?php echo $_POST['pma_password']; ?>">
<body>
<div class="jumbotron">
<div class="container">
<h2>Login to phpMyAdmin</h2>
<br>
<div class="alert alert-success"><span class="glyphicon glyphicon-circle-ok"></span> <b>Awesome!</b> Hang tight while we send you to phpMyAdmin...</div>
<form action="/dashboard/manage-mysql/phpmyadmin.php" method="POST">
<input type="hidden" value="<?php echo $username; ?>" name="pma_username">
<input type="password" disabled="disabled" required="password" name="pma_password" class="form-control" placeholder="Your MySQL password...">
<br>
<div style="text-align:right">
<input type="submit" class="btn btn-success btn-lg" value="Success" disabled="disabled">
</div>
</div>
</div>
<?php //include('../../inc/footer.php'); ?>
</div>
</div>
</body>

<?php
} else {
?>
<body>
<div class="jumbotron">
<div class="container">
<h2>Login to phpMyAdmin</h2>
<br>
<?php
if ($_GET['err'] == "1"){
?>
<div class="alert alert-danger"><b>Error:</b> Invalid MySQL login details.</div>
<?php
}
?>
<form action="/dashboard/manage-mysql/phpmyadmin.php" method="POST">
<input type="hidden" value="<?php echo $username; ?>" name="pma_username">
<input type="password" required="password" name="pma_password" class="form-control" placeholder="Your MySQL password...">
<br>
<div style="text-align:right">
<input type="submit" class="btn btn-primary btn-lg" value="Log in to phpMyAdmin">
</div>
</div>
</div>
<?php //include('../../inc/footer.php'); ?>
</div>
</div>
</body>
<?php
}
?>
