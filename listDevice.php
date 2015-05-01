<?php 
include('database.php'); 
require_once 'twig.php'; 
$pdo = Database::connect();
$devices = $pdo->query('SELECT * FROM `device`')->fetchAll();
Database::disconnect();

echo $twig->render('listDevice.html', ['devices' => $devices])
?>
