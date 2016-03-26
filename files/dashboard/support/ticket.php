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
<script>
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
</script>
<h1>Support</h1>
<p>This is where you can manage your tickets, and request support.</p>
<?php
if (empty($_REQUEST['id'])){
echo '<br><div class="alert alert-danger"><b>Error:</b> No ticket ID specified.</div>';
die();
}
$con = mysql_connect('127.0.0.1', 'root', $mysqlpassword);
mysql_select_db("admin_support");
$ticketID = htmlspecialchars($_REQUEST['id']);
if ($username == "admin"){
$query = 'select ticketId, subject, content, time, status, username from ticket_entries where ticketID="'.$ticketID.'";';
$results = mysql_query($query);
$nextquery = 'select ticketId, subject, content, time, username from replies where ticket_entryID="'.$ticketID.'";';
$replies = mysql_query($nextquery);
} else {
$query = 'select ticketId, subject, content, time, status, username from ticket_entries where username="'.$username.'" and ticketID="'.$ticketID.'";';
$results = mysql_query($query);
$nextquery = 'select ticketId, subject, content, time, username from replies where ticket_entryID="'.$ticketID.'";';
$replies = mysql_query($nextquery);
}
if (mysql_num_rows($results) == "0"){
echo '<br> </br>';
echo "<div class='alert alert-danger'><b>Error!</b> Either this ticket doesn't exist, or it doesn't belong to you. Back to <a href='/dashboard/support'>support center</a>.</div>";
die();
} else {

if ($_GET['action'] == "close"){
$closeQuery = 'UPDATE ticket_entries SET status="Closed" WHERE ticketID="'.$ticketID.'";';
$closeResults = mysql_query($closeQuery);
echo '<div class="alert alert-success"><b>Success: </b>This ticket has been closed.</div>';
echo '<meta http-equiv="refresh" content="3; ./ticket.php?id='.$ticketID.'">';
}

?>
<br>
<div class="panel panel-default">
<?php
while($row = mysql_fetch_array($results))
  {

  if ($row['status'] == "Closed"){
  $closed = "yes";
  }
  //$ticketID = $row['ticketID'];
  $date = $row['time'];
  $ticketStatus = $row['status'];
  if (empty($row['subject'])){
  $subject = "(no subject)";
  } else {
  $subject = $row['subject'];
  }
  echo '<div class="panel-heading"><b>Ticket name: '.$subject.'</b><span style="float: right;"><i><b>Ticket status:</b> '.$ticketStatus.'</i></span></div>';
  echo '<div class="panel-body">';
  $rowusername = $row['username'];
  echo '<b>'.$rowusername.'</b><span style="float: right;"><b>Date:</b> '.$date.'</span>';
  echo '<br> </br>';
  echo nl2br($row["content"]);
  echo '</div>';
  }

?>
<?php
if (mysql_num_rows($replies) == "0"){
echo '<hr><center>';
echo '<i>No replies found.</i></center>';
echo '<br>';
}

while($row2 = mysql_fetch_array($replies))
  {
  $ticketID2 = $row2['ticketID'];
  $date = $row2['time'];
  echo '<hr>';
  echo '<div class="container">';
  $rowusername = $row2['username'];
  if ($rowusername == "admin"){
  echo '<b>Staff</b><span style="float: right;"><b>Date:</b> '.$date.'</span></div>';
  } else {
  echo '<b>'.$rowusername.'</b><span style="float: right;"><b>Date:</b> '.$date.'</span></div>';
  }
  echo '<br><div class="container">';
  echo nl2br($row2["content"]);
  echo '</div><br>';
  }

?>
<hr>
<div class="container">
<p><b>Reply</b></p>
<?php
if ($closed == "yes"){
if ($_GET['action'] == "delete" && $_GET['confirm'] == "yes"){
mysql_select_db("admin_support");
$ticketID = $_REQUEST['id'];
$lastUpdatedBy1 = 'UPDATE ticket_entries SET username="removed" WHERE ticketID="'.$ticketID.'";';
//$lastUpdatedBy2 = 'UPDATE replies SET username="removed" WHERE ticketID="'.$ticketID.'";';
$lastUpdatedByQuery1 = mysql_query($lastUpdatedBy1);
//$lastUpdatedByQuery2 = mysql_query($lastUpdatedBy2);
echo '<div class="alert alert-success"><b>Success:</b> This ticket has been erased. <a onclick="window.close();">Return to support center</a></div>';
die();
}
echo "<div class='alert alert-info'><b>Notice: </b>This ticket has been closed. Open a new ticket if another problem arises.</div>";
echo "<br>";
if ($_GET['action'] == "delete" && $_GET['confirm'] !== "yes"){
echo '<p>Are you sure you want to remove this ticket?</p>';
echo '<div class="btn-group-vertical btn-block">';
echo '<a href="/dashboard/support/ticket.php?id='.$ticketID.'" class="btn btn-block btn-success">Cancel</a>';
echo '<a href="/dashboard/support/ticket.php?id='.$ticketID.'&action=delete&confirm=yes" class="btn btn-block btn-danger">I understand this will irreversably erase this ticket. Proceed.</a></div><br> </br>';
} else {
echo '<div class="btn-group-vertical btn-block">';
echo '<a onclick="window.close();" class="btn btn-primary btn-block">Return to Support Center</a>';
echo '<a href="/dashboard/support/ticket.php?id='.$ticketID.'&action=delete" class="btn btn-danger">Delete Ticket</a></div><br> </br>';
}
die();
} 
if (empty($_POST['reply'])){
?>
<form action="ticket.php?id=<?php echo $ticketID; ?>" method="POST">
<textarea class="form-control" rows="5" id="reply" name="reply"></textarea>
<br>
<div class="btn-group">
<input type="submit" class="btn btn-success" value="Reply">
<a href="./ticket.php?id=<?php echo $ticketID; ?>&action=close" class="btn btn-danger">Close ticket</a>
</div>
<br>
<br>
<a onclick="window.close();" class="btn btn-primary btn-block">Return to Support Center</a>
</form>
<?php
} else {
$lastUpdatedBy = 'UPDATE ticket_entries SET last_updated="'.$username.'" WHERE ticketID="'.$ticketID.'";';
$lastUpdatedByQuery = mysql_query($lastUpdatedBy);
$today = date("Y-m-d H:i:s");
$replyContent = htmlspecialchars($_POST['reply']);
$replyQuery = 'INSERT INTO replies '.'(username, subject, content, time, ticket_entryID) '.' VALUES ( "'.$username.'", "'.$subject.'", "'.$replyContent.'", "'.$today.'", "'.$ticketID.'");';
$replyResults = mysql_query($replyQuery);
echo '<div class="alert alert-success"><b>Success: </b>Reply added! Click <a href="ticket.php?id='.$ticketID.'">here</a> to go back.</div>';
}
?>
<br>
</div>
</div>
<?php
}
?>

<br> </br>
<?php include('../../inc/footer.php'); ?>
</div>
</div>
</body>

