<?php
require('check.php');
include('../inc/header.php');
$username = $_SESSION['username'];
$domain = $_GET['domain'];
?>
<br> </br>
<script type="text/javascript">
EnableSubmit = function(val)
{
    var sbmt = document.getElementById("deleteBtn");
    var dellater = document.getElementById("delAfterClick");

    if (val.checked == true)
    {
        sbmt.style.display = 'block';
        dellater.style.display = 'none';   
    }
    else
    {
        sbmt.style.display = 'none';
    }
}

window.onunload = refreshParent;
function refreshParent() {
    window.opener.location.reload();
}
</script>
<title>Purge website</title>
<div class="container">
<h1><b>Purge website</b></h1>
<h3>Performing action on: <?php echo $_GET['domain']; ?></h3>
<hr>
<br>
<?php
$filename2 = "/home/".$username;
$filename = $filename2."/".$domain."-access.log";
if (file_exists($filename)) {
$out = shell_exec('tail -n 20 '.$filename); 
if (empty($out)){

if ($_GET['action'] == "delete"){

$domain_name = $_GET['domain'];
shell_exec('/sbin/apache_killvhost '.$domain_name.' --force');
echo '<div class="alert alert-success"><b>Success:</b> The virtual host has been removed.</div>';
echo '<br><hr></br>';
echo '<a onclick="window.close();" class="btn btn-danger btn-lg">Close</a>';
die();

}
?>
<p>Please remember that this will not remove bandwidth statistics or the contents of your public webspace directory.</p>
<p>This will simply remove a virtual host which you no longer wish to keep.</p>
<br> <br />
<div id="delAfterClick">
<pre><input type="checkbox" onclick="EnableSubmit(this)">  I understand the consequences and assume responsibility for my actions.
</pre>
</div>

<div id="deleteBtn" style="display: none;">
<br> <br />
<form action="delete_website.php" method="GET">
<input type="hidden" name="action" value="delete">
<input type="hidden" name="domain" value="<?php echo $_GET['domain']; ?>">
<input type="submit" class="btn btn-warning btn-block btn-lg" value="Purge website">
</form>
</div>

<br>
</div>
<?php
} else {
if ($_GET['action'] == "delete"){

$domain_name = $_GET['domain'];
shell_exec('/sbin/apache_killvhost '.$domain_name.' --force');
echo '<div class="alert alert-success"><b>Success:</b> The virtual host has been removed.</div>';
echo '<br><hr></br>';
echo '<a onclick="window.close();" class="btn btn-danger btn-lg">Close</a>';
die();

}
?>
<p>Please remember that this will not remove bandwidth statistics or the contents of your public webspace directory.</p>
<p>This will simply remove a virtual host which you no longer wish to keep.</p>
<br> <br />
<div id="delAfterClick">
<pre><input type="checkbox" onclick="EnableSubmit(this)">  I understand the consequences and assume responsibility for my actions.
</pre>
</div>

<div id="deleteBtn" style="display: none;">
<br> <br />
<form action="delete_website.php" method="GET">
<input type="hidden" name="action" value="delete">
<input type="hidden" name="domain" value="<?php echo $_GET['domain']; ?>">
<input type="submit" class="btn btn-warning btn-block btn-lg" value="Purge website">
</form>
</div>

<?php
}
} else { 
echo 'Either you do not own this domain, or it does not exist.'; 
}
?>
</pre>

<div class="container">

<br><hr></br>

<a onclick="window.close();" class="btn btn-danger btn-lg">Cancel</a>

<br> </br>

</div>
