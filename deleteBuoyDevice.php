<?php
include('database.php'); 
$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];
$device_id = (int) $_GET['device_id']; 
$sql = "DELETE FROM `buoy_device` WHERE `latitude` = ? AND " .
    "`longitude` = ? AND `device_id` = ? "; 
$pdo = Database::connect();
$q = $pdo->prepare($sql);
try {
	$q->execute(array($latitude,$longitude,$device_id));
}catch (PDOException $e){
	die($e->getMessage());
}

Database::disconnect();
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='listBuoyDevice.php'>Back To Listing</a>
