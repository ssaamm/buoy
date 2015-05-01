<?php
include('database.php'); 
require_once 'twig.php';

$params = ['object' => 'Reading'];

$device_id = $_GET['device_id']; 
$time = $_GET['time']; 
$sql = "DELETE FROM `reading` WHERE `device_id` = ? AND `time` = ?"; 
$pdo = Database::connect();
$q = $pdo->prepare($sql);
try{
	$q->execute(array($device_id,$time));
}catch (PDOException $e){
    $params['err'] = $e->getMessage();
}
Database::disconnect();

echo $twig->render('deleteObject.html', $params);
?> 
