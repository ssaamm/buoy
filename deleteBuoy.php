<?php 
include('database.php'); 
require_once 'twig.php';

$params = ['object' => 'Buoy'];

$latitude = (int) $_GET['latitude']; 
$longitude = (int) $_GET['longitude']; 
$sql = "DELETE FROM `buoy` WHERE `latitude` = ? AND `longitude` = ? ";
$pdo = Database::connect();
$q = $pdo->prepare($sql);
try{
	$q -> execute(array($latitude, $longitude));
}catch(PDOException $e){
    $params['err'] = $e->getMessage();
}
Database::disconnect(); 

echo $twig->render('deleteObject.html', $params);
?> 
