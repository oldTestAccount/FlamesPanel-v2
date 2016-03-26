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
<br>
<?php
if ($username == "admin"){

$con = mysql_connect('127.0.0.1', 'root', $mysqlpassword);
mysql_select_db("admin_support");
$ignore_closed = $_GET['ignore'];
if ($ignore_closed == "do"){
$query = 'select * from ticket_entries where username != "removed";';
} else {
$query = 'select * from ticket_entries;';
}
$results = mysql_query($query);

?>
<br>
<div class="btn-group">
<a class="btn btn-danger" href="/dashboard/support/?ignore=do">Hide deleted tickets</a>
<a class="btn btn-success" href="/dashboard/support/">Show deleted tickets</a>
</div>
<br> </br>
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>Ticket ID</th>
<th>Name</th>
<th>Status</th>
<th>Last updated by</th>
<th>From</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php
while($row = mysql_fetch_array($results))
  {
  $ticketID = $row['ticketID'];
  echo '<tr>';
  echo '<td>'.$row['ticketID'].'</td>';
  if (empty($row['subject'])){
  echo '<td>(no subject)</td>';
  } else {
  echo '<td>'.$row['subject'].'</td>';
  }
  if ($row['status'] == "Open"){
  echo '<td><span class="label label-success">Open</span></td>';
  } else {
  echo '<td><span class="label label-danger">Closed</span></td>';
  }
  if ($row['last_updated'] == "admin"){
  echo '<td>Staff</td>';
  } else {
  echo '<td>'.$row["last_updated"].'</td>';
  }
  echo '<td>'.$row['username'].'</td>';
  echo '<td><a href="ticket.php?id='.$ticketID.'" target="_blank">View</a></td>';
  echo '</tr>';
  }
?>
</tbody>
</table>

<?php
die();
}
?>

<a href="create.php" class="btn btn-primary btn-lg btn-block">Create Ticket</a>
<?php
$con = mysql_connect('127.0.0.1', 'root', $mysqlpassword);
mysql_select_db("admin_support");
$query = 'select * from ticket_entries where username="'.$username.'";';
$results = mysql_query($query);
if (mysql_num_rows($results) == "0"){
echo '<br> </br>';
echo '<div class="alert alert-danger"><i><b>Sorry,</b></i> No support tickets found.</div>';
} else {
?>
<br> </br>
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>Ticket ID</th>
<th>Name</th>
<th>Status</th>
<th>Last updated by</th>
<th>Actions</th>
</tr>
</thead> 
<tbody>
<?php
while($row = mysql_fetch_array($results))
  {
  $ticketID = $row['ticketID'];
  echo '<tr>';
  echo '<td>'.$row['ticketID'].'</td>';
  if (empty($row['subject'])){
  echo '<td>(no subject)</td>';
  } else {
  echo '<td>'.$row['subject'].'</td>';
  }
  $status = $row['status'];
  if ($status == "Open"){
  echo '<td><span class="label label-success">Open</span></td>';
  } else {
  echo '<td><span class="label label-danger">Closed</span></td>';
  }
  if ($row['last_updated'] == "admin"){
  echo '<td>Staff</td>';
  } else {
  echo '<td>'.$row["last_updated"].'</td>';
  }
  echo '<td><a href="ticket.php?id='.$ticketID.'" target="_blank">View</a></td>';
  echo '</tr>';
  }
?>
</tbody>
</table>
<?php
}
?>

<br> </br>
<?php include('../../inc/footer.php'); ?>
</div>
</div>
</body>

