<?php
include('database.php'); 
require_once 'twig.php';

$created = false;
if (isset($_POST['submitted'])) { 
    $sql = "INSERT INTO `reading` ( `device_id` ,  `time` ,  `dimension0` ,  `dimension1`  ) VALUES(  ? , ? ,  ? ,  ?  ) "; 
    $pdo = Database::connect();
    $q = $pdo->prepare($sql);
    try {
        $created = $q->execute(array($_POST['device_id'], $_POST['time'], $_POST['dimension0'], (empty($_POST['dimension1']) ? null : $_POST['dimension1'])));
    }catch (PDOException $e){
        echo $twig->render('newReading.html', ['err' => $e->getMessage()]);
        exit;
    }
    Database::disconnect();
} 
echo $twig->render('newReading.html', ['created' => $created]);
?>
