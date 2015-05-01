<?php
include('database.php'); 
require_once 'twig.php'; 
$pdo = Database::connect();
$buoy_devices = $pdo->query('SELECT * FROM `buoy_device`')->fetchAll();
Database::disconnect();

echo $twig->render('listBuoyDevice.html', ['buoy_devices' => $buoy_devices])
?>
