<?php
include('database.php'); 
require_once 'twig.php';

$row = null;
$edited = false;
if (isset($_GET['device_id']) && isset($_GET['time']) ) { 
    $device_id = $_GET['device_id']; 
    $time = $_GET['time']; 
    $pdo = Database::connect();
    if (isset($_POST['submitted'])) { 
        $sql = "UPDATE `reading` SET  `dimension0` = ? ,  `dimension1` = ?  ".
             "WHERE  `device_id` = ? AND `time` = ?"; 

        $q = $pdo->prepare($sql);
        try {
            $edited = $q->execute(array($_POST['dimension0'],$_POST['dimension1'],$device_id,$time));
        }catch (PDOException $e){
            $err = $e->getMessage();
            echo $twig->render('editReading.html', ['err' => $e->getMessage()]);
            exit;
        }
    } 
    $sql2 = "SELECT * FROM `reading` WHERE `device_id` = $device_id AND `time` = '$time'"; 

    $q = $pdo->prepare($sql2);
    try{
        $q->execute(array($device_id,$time));
        $row = $q->fetch();
    }catch(PDOException $e){
        $err = $e->getMessage();
        echo $twig->render('editReading.html', ['err' => $e->getMessage()]);
        exit;
    }
    Database::disconnect();
}
echo $twig->render('editReading.html', ['row' => $row, 'edited' => $edited]);
?>
