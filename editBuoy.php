<?php
include('database.php'); 
require_once 'twig.php';

$row = null;
$edited = false;
if (isset($_GET['latitude']) && isset($_GET['longitude']) ) { 
    $latitude = $_GET['latitude']; 
    $longitude = $_GET['longitude']; 
    $pdo = Database::connect();
    if (isset($_POST['submitted'])) { 
        $sql = "UPDATE `buoy` SET  `name` =  ? ,  `latitude` =  ? ,  `longitude` =  ? ,  `elevation` =  ? ,  `depth` =  ?   WHERE `latitude` = ?  AND `longitude` = ? "; 

        $q = $pdo->prepare($sql);
        try {
            $edited = $q->execute(array($_POST['name'],$_POST['latitude'],$_POST['longitude'],$_POST['elevation'],$_POST['depth'],$latitude,$longitude));
        }catch (PDOException $e){
            $err = $e->getMessage();
            echo $twig->render('editBuoy.html', ['err' => $e->getMessage()]);
            exit;
        }
    } 
    $sql2 = "SELECT * FROM `buoy` WHERE `latitude` = ? AND `longitude` = ? ";

    $q = $pdo->prepare($sql2);
    try{
        $q->execute(array($latitude,$longitude));
        $row = $q->fetch();
    }catch(PDOException $e){
        $err = $e->getMessage();
        echo $twig->render('editBuoy.html', ['err' => $e->getMessage()]);
        exit;
    }
    Database::disconnect();
}
echo $twig->render('editBuoy.html', ['row' => $row, 'edited' => $edited]);
?>
