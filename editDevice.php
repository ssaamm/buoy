<?php
include('database.php'); 
require_once 'twig.php';

$row = null;
$edited = false;
if (isset($_GET['id']) ) { 
    $id = (int) $_GET['id']; 
    $pdo = Database::connect();
    if (isset($_POST['submitted'])) { 
        $sql = "UPDATE `device` SET  `device_type` =  ? WHERE `id` = ?"; 
        $pdo = Database::connect();
        $q = $pdo->prepare($sql);
        try {
            $edited = $q->execute(array($_POST['device_type'],$id));
        }catch(PDOException $e){
            $err = $e->getMessage();
            echo $twig->render('editDevice.html', ['err' => $e->getMessage()]);
            exit;
        }
    } 
    $sql2 = "SELECT * FROM `device` WHERE `id` = ? ";
    $q = $pdo->prepare($sql2);
    try{
        $q->execute(array($id));
        $row = $q->fetch();
    }catch(PDOException $e){
        $err = $e->getMessage();
        echo $twig->render('editDevice.html', ['err' => $e->getMessage()]);
        exit;
    }

    Database::disconnect();
}
echo $twig->render('editDevice.html', ['row' => $row, 'edited' => $edited]);
?> 
