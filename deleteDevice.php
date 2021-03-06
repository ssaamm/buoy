<?php
include('database.php'); 
require_once 'twig.php';

$params = ['object' => 'Device'];

$id = (int) $_GET['id']; 
$sql = "DELETE FROM `device` WHERE `id` = ? ";
$pdo = Database::connect();
$q = $pdo->prepare($sql);
try {
	$q->execute(array($id));
}catch (PDOException $e){
    $params['err'] = $e->getMessage();
}

Database::disconnect();

echo $twig->render('deleteObject.html', $params);
?> 
