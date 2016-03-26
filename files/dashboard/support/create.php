<?php
require('check.php');
include('../config.php');
include('../inc/header.php');
include('../inc/navbar.php');
$username = $_SESSION['username'];
?>

<body>
<br> </br>
<div class="jumbotron">
<div class="container">
<h1>Support</h1>
<p>This is where you can manage your tickets, and request support.</p>
<hr>
<h3><b>Create Ticket</b></h3>
<?php
if (!empty($_POST['content']) && !empty($_POST['subject'])){
$con = mysql_connect('127.0.0.1', 'root', $mysqlpassword);
mysql_select_db("admin_support");
$content = htmlspecialchars($_POST['content']);
$subject = htmlspecialchars($_POST['subject']);
$today = date("Y-m-d H:i:s"); 
$ticketID = htmlspecialchars($_GET['id']);
$query = 'INSERT INTO ticket_entries '.'(username, subject, content, time, status, last_updated) '.' VALUES ( "'.$username.'", "'.$subject.'", "'.$content.'", "'.$today.'", "Open", "'.$username.'");';
$results = mysql_query($query);
?>
<br> </br>
<div class="alert alert-success"><b>Success: </b>Your ticket was created successfully!</div>
<br>
<a href="/dashboard/support" class="btn btn-primary btn-block">Back</a>
<?php
} else {
?>

<form action="create.php" method="POST">
<input type="text" class="form-control" name="subject" placeholder="Subject">
<br>
<textarea placeholder="Ticket content..." class="form-control" rows="5" id="content" name="content"></textarea>
<br>
<div class="btn-group-vertical btn-block">
<input type="submit" class="btn btn-success" value="Create ticket">
<a href="/dashboard/support" class="btn btn-primary btn-block">Return to Support Center</a>
</div>
</form>
<?php
}
?>
<br> </br>
<?php include('../../inc/footer.php'); ?>
</div>
</div>
</body>

