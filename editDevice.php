<?php
include('database.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `device` SET  `device_type` =  ? WHERE `id` = ?"; 
$pdo = Database::connect();
$q = $pdo->prepare($sql);
try {
	$q->execute(array($_POST['device_type'],$id);
}catch(PDOException $e){
	die($e->getMessage());
}
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='listDevice.php'>Back To Listing</a>"; 
} 
$sql2 = "SELECT * FROM `device` WHERE `id` = '$id' ";
$q = $pdo->prepare($sql2);

try{
	$row = $q->execute(array($id));
}catch(PDOException $e){
	die($e->getMessage());
}
Database::disconnect();
?>

<form action='' method='POST'> 
<p><b>Device Type:</b><br /><input type='text' name='device_type' value='<?= stripslashes($row['device_type']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
