<?php 
include('database.php'); 
require_once 'twig.php';

$created = false;
if (isset($_POST['submitted'])) { 
    $sql = "INSERT INTO `buoy_device` ( `latitude` ,  `longitude` ,  `device_id`  ) VALUES( ?, ? , ? ) "; 
    $pdo = Database::connect();
    $q = $pdo->prepare($sql);
    try{
        $created = $q ->execute(array($_POST['latitude'],$_POST['longitude'],$_POST['device_id']));
    }catch (PDOException $e){
        echo $twig->render('newBuoyDevice.html', ['err' => $e->getMessage()]);
        exit;
    }
    Database::disconnect();
} 
echo $twig->render('newBuoyDevice.html', ['created' => $created]);
?>
