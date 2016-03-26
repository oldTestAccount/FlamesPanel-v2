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
<h1>Personalize the Control Panel</h1>

<p>This is where you can customize the panel, by adding things like a background image.</p>

<?php
if ($_GET['error'] == "invalidType"){
echo '<div class="alert alert-danger"><b>Error:</b> Image format invalid.</div>';
} else if ($_GET['error'] == "tooLarge"){
echo '<div class="alert alert-danger"><b>Error:</b> Image too large!</div>';
} else if ($_GET['error'] == "invalidImage"){
echo '<div class="alert alert-danger"><b>Error:</b> The file uploaded is not an image.</div>';
} else if ($_GET['error'] == "alreadyExists"){
echo '<div class="alert alert-danger"><b>Error:</b> Image already exists.</div>';
} else if ($_GET['msg'] == "success"){
echo '<div class="alert alert-success">Image uploaded successfully!</div>';
} else if ($_GET['error'] == "errorUploading"){
echo '<div class="alert alert-danger"><b>Error:</b> Failed to upload.</div>';
} else if ($_GET['reset'] == "do"){
shell_exec("rm -rf /home/".$username."/cP-bg.png");
echo '<div class="alert alert-success"><b>Success!</b> Your background image has been removed. Refreshing page for changes to take effect...</div>';
echo '<meta http-equiv="refresh" content="3; url=https://cp.flameshost.com/dashboard/customize">';
}
?>

<form action="upload.php" method="post" enctype="multipart/form-data">

<div class="well well-sm"><input type="file" name="fileToUpload" id="fileToUpload"></div>

    <br>
    <input type="submit" class="btn btn-success" value="Upload Background Image" name="submit">
    <br> </br>
    <a href="./?reset=do" class="btn btn-danger">Clear image</a>
 
</form>
<br> </br>
<?php include('../../inc/footer.php'); ?>
</div>
</div>

<?php

//$imagedata = file_get_contents("/home/".$username."/cP-bg.png");
             // alternatively specify an URL, if PHP settings allow
//$base64 = base64_encode($imagedata);

?>

<?php
//if (file_exists("/home/".$username."/cP-bg.png")) {
//echo '<div class="panel panel-lg"><img src="data:image/png;base64,' . $base64 . '" /></div>';
//} else {
//echo '<div class="alert alert-danger">No image found.</div>';
//}
?>
</div>
</div>

<?php //include('../../inc/footer.php'); ?>


