<?php 
include('database.php'); 
require_once 'twig.php'; 
$pdo = Database::connect();
$readings = $pdo->query('SELECT * FROM `reading`')->fetchAll();
Database::disconnect();

echo $twig->render('listReading.html', ['readings' => $readings])
?>
