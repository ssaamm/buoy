<?php
include 'database.php'; 
require_once 'twig.php';

$pdo = Database::connect();
if (!empty($_GET['fmt']) && $_GET['fmt'] == 'json') {
    $response = [];
    try {
        $buoys = $pdo->query("SELECT * FROM `buoy`");
    } catch (PDOException $e) {
        $response['error'] = $e->getMessage();
        echo json_encode($response);
        exit;
    }

    while ($buoy = $buoys->fetch()) {
        $response['buoys'][] = $buoy;
    }
    echo json_encode($response);
    exit;
}

$sql = "SELECT * FROM `buoy`";
$buoys = $pdo->query('SELECT * FROM `buoy`')->fetchAll();
Database::disconnect();

echo $twig->render('listBuoy.html', ['buoys' => $buoys]);
?>
