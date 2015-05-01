<?php
include('database.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `reading` ( `device_id` ,  `time` ,  `dimension0` ,  `dimension1`  ) VALUES(  ? , ? ,  ? ,  ?  ) "; 
$pdo = Database::connect();
$q = $pdo->prepare($sql);
$q->execute(array($_POST['device_id'], $_POST['time'], $_POST['dimension0'], $_POST['dimension1']));

Database::disconnect();
echo "Added row.<br />"; 
echo "<a href='listReading.php'>Back To Listing</a>"; 
} 
?>

<form action='' method='POST'> 
<p><b>Device Id:</b><br /><input type='text' name='device_id'/> 
<p><b>Time:</b><br /><input type='text' name='time'/> 
<p><b>Dimension0:</b><br /><input type='text' name='dimension0'/> 
<p><b>Dimension1:</b><br /><input type='text' name='dimension1'/> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
