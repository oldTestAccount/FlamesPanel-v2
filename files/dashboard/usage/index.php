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
<h1>Usage Information</h1>
<p>This is where you can find your disk space usage stats, as well as how many files you have.</p>
<pre><?php echo shell_exec('/bin/apache_usage '.$username); ?>Please note: This information is accurate as of <?php echo date("Y-m-d H:i:s"); ?></pre>
<br> </br>
<?php include('../../inc/footer.php'); ?>
</div>
</div>
</body>

