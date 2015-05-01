<?php
include('database.php'); 
require_once 'twig.php';

$created = false;
if (isset($_POST['submitted'])) { 
    $sql = "INSERT INTO `device` ( `device_type`  ) VALUES( ? ) "; 
    $pdo = Database::connect();
    $q = $pdo->prepare($sql);
    try{
        $created = $q ->execute(array($_POST['device_type']));
    }catch (PDOException $e){
        echo $twig->render('newDevice.html', ['err' => $e->getMessage()]);
        exit;
    }
    Database::disconnect();
} 
echo $twig->render('newDevice.html', ['created' => $created]);
?>
