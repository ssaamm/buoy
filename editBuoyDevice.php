<?php
include('database.php'); 
require_once 'twig.php';

$row = null;
$edited = false;
if (isset($_GET['latitude']) && isset($_GET['longitude']) ) { 
    $latitude = $_GET['latitude']; 
    $longitude = $_GET['longitude']; 
    $device_id = (int) $_GET['device_id'];
    $pdo = Database::connect();
    if (isset($_POST['submitted'])) { 
        $sql = "UPDATE `buoy_device` SET  `latitude` =  ? ,  `longitude` = ? ,  `device_id` = ? " .
            "WHERE `latitude` = ? AND `longitude` = ? AND `device_id` = ?"; 
        $pdo = Database::connect();
        $q = $pdo->prepare($sql);
        try {
            $edited = $q->execute(array($_POST['latitude'],$_POST['longitude'],$_POST['device_id'], $latitude, $longitude, $device_id));
        }catch(PDOException $e){
            $err = $e->getMessage();
            echo $twig->render('editBuoyDevice.html', ['err' => $e->getMessage()]);
            exit;
        }
    } 
    $sql2 = "SELECT * FROM `buoy_device` WHERE `latitude` = ? AND `longitude` = ?AND `device_id` = ?";
    $q = $pdo->prepare($sql2);
    try{
        $q->execute(array($latitude,$longitude,$device_id));
        $row = $q->fetch();
    }catch(PDOException $e){
        $err = $e->getMessage();
        echo $twig->render('editBuoyDevice.html', ['err' => $e->getMessage()]);
        exit;
    }

    Database::disconnect();
}
echo $twig->render('editBuoyDevice.html', ['row' => $row, 'edited' => $edited]);
?> 
