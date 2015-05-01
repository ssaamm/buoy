<?php
include('database.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `device` ( `device_type`  ) VALUES( ? ) "; 
$pdo = Database.connect();
$q = $pdo->prepare($sql);
try{
	$q ->execute(array($_POST['device_type']));
}catch (PDOException $e){
	die($e->getMessage());
}
Database::disconnect();
echo "Added row.<br />"; 
echo "<a href='listDevice.php'>Back To Listing</a>"; 
} 
?>

<form action='' method='POST'> 
<p><b>Device Type:</b><br /><input type='text' name='device_type'/> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
