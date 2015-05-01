<?php
include('database.php'); 
if (isset($_GET['latitude']) && isset($_GET['longitude']) && isset($_GET['device_id'])) { 
$latitude = $_GET['latitude']; 
$longitude = $_GET['longitude']; 
$device_id = (int) $_GET['device_id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `buoy_device` SET  `latitude` =  ? ,  `longitude` = ? ,  `device_id` = ? " .
    "WHERE `latitude` = ? AND `longitude` = ? AND `device_id` = ?"; 
$pdo = Database::connect();
$q = $pdo->prepare($sql);
try {
	$q->execute(array($_POST['latitude'],$_POST['longitude'],$_POST['device_id'], $latitude, $longitude, $device_id);
}catch(PDOException $e){
	die($e->getMessage());
}
echo "<a href='listBuoyDevice.php'>Back To Listing</a>"; 
} 
$sql2 = "SELECT * FROM `buoy_device` WHERE `latitude` = ? AND `longitude` = ?AND `device_id` = ?";
$q = $pdo->prepare($sql2);
try{
	$q->execute(array($latitude,$longitude,$device_id));
	$row = $q->fetch();
}catch(PDOException $e){
	die($e->getMessage());
}

Database::disconnect();
?>

<form action='' method='POST'> 
<p><b>Latitude:</b><br /><input type='text' name='latitude' value='<?= stripslashes($row['latitude']) ?>' /> 
<p><b>Longitude:</b><br /><input type='text' name='longitude' value='<?= stripslashes($row['longitude']) ?>' /> 
<p><b>Device Id:</b><br /><input type='text' name='device_id' value='<?= stripslashes($row['device_id']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
