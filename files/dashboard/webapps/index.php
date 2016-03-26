<?php
require('check.php');
require('../inc/header.php');
require('../inc/navbar.php');

$websites1 = shell_exec("/bin/apache_listwebsites ".$username);
$pendingWebsites1 = shell_exec("/bin/apache_listpending ".$username);
$websites2 = str_replace("#", "", $websites1);
$websites = str_replace("/ ".$username, "", $websites2);
$pendingWebsites2 = str_replace("#", "", $pendingWebsites1);
$pendingWebsites = str_replace("/ ".$username, "", $pendingWebsites2);

?>
<div class="jumbotron">
<br> <br />
<div class="container">
<h1>Web Application Installer</h1>
<?php
function generateRandomString($length = 7) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (!empty($_POST['website']) && $_POST['software'] == "WordPress" && !empty($_POST['mysql_password'])){
$db_name = generateRandomString();
$mysql_password = $_POST['mysql_password'];
$website = $_POST['website'];

// Create connection
$conn = new mysqli('127.0.0.1', $username, $mysql_password);

// Check connection
if ($conn->connect_error) {

echo '<br> <br />';
echo '<div class="alert alert-danger"><b>Error: </b>The MySQL password you specified is invalid. Press <a href="/dashboard/webapps">here</a> to go back.</div>';
die();

} 

if (!file_exists('/home/'.$username.'/public_html/'.$website) && !file_exists('/home/'.$username.'/'.$website.'-error.log')){
echo '<br> <br />';
echo '<div class="alert alert-danger"><b>Error: </b>The website specified does not belong to you. Press <a href="/dashboard/webapps">here</a> to go back.</div>';
die();
}

shell_exec('rm -rf /home/'.$username.'/public_html/'.$website.'/*');
shell_exec('cp -R /opt/wordpress/* /home/'.$username.'/public_html/'.$website.'/');
shell_exec('/bin/wordpress_db '.$username.' '.$mysql_password.' '.$website.' '.$db_name); 
echo '<br> <br />';
echo '<div class="alert alert-success"><b>Success: </b>WordPress has been successfully installed on <a target="_blank" href="http://'.$website.'">http://'.$website.'</a>! Press <a href="/dashboard/webapps">here</a> to go back.</div>';
die();
}
?>
<p>Currently, only WordPress can be installed automatically.</p>
<p><b>Please remember that any files in your webspace will be overwritten.</b></p>
<p>Please select the domain you wish to install the software on, and then the software.</p>
<br>
<form action="" method="POST" id="selectForm">
<label><b>Application: </b></label>
<select class="form-control" name="software" form="selectForm">
<option value="WordPress">WordPress</option>
</select>
<br>
<label><b>Selected website: </b></label>
<select class="form-control" name="website" form="selectForm">
<?php
if (preg_match('/none/',$websites)){
echo "<option>No websites have been created.</option>";
} else {
$lines = split("\n", $websites);
foreach ($lines as $line) {
    $trimmed = trim($line);
    if (empty($trimmed)){
    } else {
    $ipv6_of_domain = shell_exec('/bin/apache_getv6 '.$trimmed);
    $processedv6 = str_replace("#", "", $ipv6_of_domain);
    $finalv62 = str_replace("- ".$trimmed, "", $processedv6);
    $finalv6 = trim($finalv62);
    echo '<option value="'.$trimmed.'">'.$trimmed.'</option>';
    }
}
}
?>
</select>
<br>
<label><b>Your MySQL Password: </b></label>
<input type="password" class="form-control" name="mysql_password" placeholder="MySQL Password...">
<br>
<input type="submit" class="btn btn-success" style="float: right;" value="Install Application">
</form>
</div>
</div>
