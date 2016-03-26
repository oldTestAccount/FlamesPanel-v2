<?php
require('check.php');
include('../inc/header.php');
$username = $_SESSION['username'];
$domain = $_GET['domain'];
?>
<br> </br>
<title>View Logs</title>
<div class="container">
<h1><b>Log Viewer</b></h1>
<h3>Displaying access logs for the domain: <?php echo $_GET['domain']; ?></h3>
<hr>
<br>
<h3><b>Access Logs</b></h3>
<?php
$filename2 = "/home/".$username;
$filename = $filename2."/".$domain."-access.log";
?>
<pre>
<?php if (file_exists($filename)) {
$out = shell_exec('tail -n 20 '.$filename); 
if (empty($out)){
echo 'No access logs found.';
} else {
echo $out;
}
} else { 
echo 'Either you do not own this domain, or it does not exist.'; 
}
?>
</pre>
<br>
<h3><b>Error Logs</b></h3>
<pre>
<?php
$filename3 = "/home/".$username;
$filename4 = $filename2."/".$domain."-error.log";
?>
<?php if (file_exists($filename4)) {
$out = shell_exec('tail -n 20 '.$filename4);
if (empty($out)){
echo 'No error logs found.';
} else {
echo $out;
}
} else {
echo 'Either you do not own this domain, or it does not exist.';
}
?>
</pre>

<br><hr></br>

<a onclick="window.close();" class="btn btn-danger btn-lg">Close Log Viewer</a>

<br> </br>

