<?php
session_start();
$username = $_SESSION['username'];
require('check.php');
$target_dir = "/home/".$username;
$target_file = 'cP-bg.png';
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo '<meta http-equiv="refresh" content="0; url=https://cp.flameshost.com/dashboard/customize/?error=invalidImage">';
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {

    echo '<meta http-equiv="refresh" content="0; url=https://cp.flameshost.com/dashboard/customize/?error=alreadyExists">';
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 20000000) {
    echo '<meta http-equiv="refresh" content="0; url=https://cp.flameshost.com/dashboard/customize/?error=tooLarge">';
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo '<meta http-equiv="refresh" content="0; url=https://cp.flameshost.com/dashboard/customize/?error=invalidType">';
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "/home/".$username."/cP-bg.png")) {
        echo '<meta http-equiv="refresh" content="0; url=https://cp.flameshost.com/dashboard/customize/?msg=success">';
    } else {
        echo '<meta http-equiv="refresh" content="0; url=https://cp.flameshost.com/dashboard/customize/?error=errorUploading">';
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
