<?php 
include('database.php'); 
require_once 'twig.php';

$created = false;
if (isset($_POST['submitted'])) {
    $sql = "INSERT INTO `buoy` ( `name` ,  `latitude` ,  `longitude` ,  `elevation` ,  `depth`  ) VALUES( ? , ? , ? , ? , ?  ) "; 
    $pdo = Database::connect();
    $q = $pdo->prepare($sql);
    try {
        $created = $q->execute(array($_POST['name'],$_POST['latitude'],$_POST['longitude'],$_POST['elevation'],$_POST['depth']));
    } catch(PDOException $e){
        echo $twig->render('newBuoy.html', ['err' => $e->getMessage()]);
        exit;
    }
    Database::disconnect();
} 
echo $twig->render('newBuoy.html', ['created' => $created]);
?>
