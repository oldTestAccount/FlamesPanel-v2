<?php 
session_start(); 
$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<!-- FlamesPanel v2 Header Template -->
<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc= sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>FlamesPanel v2.7 Beta</title>
<font face="Open Sans">
<!-- Header ends -->

<?php

$imagedata = file_get_contents("/home/".$username."/cP-bg.png");
             // alternatively specify an URL, if PHP settings allow
$base64 = base64_encode($imagedata);

if (file_exists("/home/".$username."/cP-bg.png")) {
//echo '<img src="data:image/png;base64,' . $base64 . '" />';
}

?>

<style type="text/css">
html {
  background: url('data:image/jpeg;base64,<?php echo $base64; ?>') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>


</head>

