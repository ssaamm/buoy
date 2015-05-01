<?php
include('database.php'); 
require_once 'twig.php';

$created = false;
if (isset($_POST['submitted'])) { 
    $sql = "INSERT INTO `device_kind` ( `dimension0_name` ,  `dimension1_name` ,  `device_name`  ) VALUES(  '? , ? ,  ? ) "; 
    $pdo = Database::connect();
    $q = $pdo->prepare($sql);
    try {
        $created = $q->execute(array($_POST['dimension0_name'],$_POST['dimension1_name'],$_POST['device_name']));
    }catch (PDOException $e){
        echo $twig->render('newDeviceKind.html', ['err' => $e->getMessage()]);
        exit;
    }
    Database::disconnect();
} 
echo $twig->render('newDeviceKind.html', ['created' => $created]);
?>
