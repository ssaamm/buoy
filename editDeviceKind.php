<?php
include('database.php'); 
require_once 'twig.php';

$row = null;
$edited = false;
if (isset($_GET['id']) ) { 
    $id = (int) $_GET['id']; 
    $pdo = Database::connect();
    if (isset($_POST['submitted'])) { 
        $sql = "UPDATE `device_kind` SET  `dimension0_name` =  ? ,  `dimension1_name` =  ? ,  `device_name` = ? WHERE `id` = ?"; 
        $pdo = Database::connect();
        $q = $pdo->prepare($sql);
        try {
            $edited = $q->execute(array($_POST['dimension0_name'],$_POST['dimension1_name'],$_POST['device_name'],$id));
        }catch(PDOException $e){
            $err = $e->getMessage();
            echo $twig->render('editDeviceKind.html', ['err' => $e->getMessage()]);
            exit;
        }
    } 
    $sql2 = "SELECT * FROM `device_kind` WHERE `id` = ?"; 
    $q = $pdo->prepare($sql2);
    try{
        $q->execute(array($id));
        $row = $q->fetch();
    }catch(PDOException $e){
        $err = $e->getMessage();
        echo $twig->render('editDeviceKind.html', ['err' => $e->getMessage()]);
        exit;
    }

    Database::disconnect();
}
echo $twig->render('editDeviceKind.html', ['row' => $row, 'edited' => $edited]);
?> 
