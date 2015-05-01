<?php
include('database.php'); 
require_once 'twig.php'; 
$pdo = Database::connect();
$devices = $pdo->query('SELECT * FROM `device_kind`')->fetchAll();
Database::disconnect();

echo $twig->render('listDeviceKind.html', ['device_kinds' => $devices])
?>
