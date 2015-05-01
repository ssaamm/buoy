<?php
include('database.php'); 
require_once 'twig.php';

$params = ['object' => 'BuoyDevice'];

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
    $params['err'] = $e->getMessage();
}

Database::disconnect();
echo $twig->render('deleteObject.html', $params);
?> 

