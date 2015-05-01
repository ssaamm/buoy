<?php
include('database.php'); 
$device_id = $_GET['device_id']; 
$time = $_GET['time']; 
$sql = "DELETE FROM `reading` WHERE `device_id` = ? AND `time` = ?"; 
$pdo = Database::connect();
$q = $pdo->prepare($sql);
try{
	$q->execute(array($device_id,$time));
}catch (PDOException $e){
	die($e->getMessage());
}
Database::disconnect();
?> 

<a href='listReading.php'>Back To Listing</a>
