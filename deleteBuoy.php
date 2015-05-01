<?php 
include('database.php'); 
$latitude = (int) $_GET['latitude']; 
$longitude = (int) $_GET['longitude']; 
$sql = "DELETE FROM `buoy` WHERE `latitude` = ? AND `longitude` = ? ";
$pdo = Database::connect();
$q = $pdo->prepare($sql);
try{
	$q -> execute(array($latitude, $longitude));
}catch(PDOException $e){
	die($e->getMessage());
}
Database::disconnect(); 
?> 

<a href='listBuoy.php'>Back To Listing</a>
