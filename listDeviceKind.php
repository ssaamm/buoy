<?php
include('database.php'); 
require_once 'twig.php'; 
$pdo = Database::connect();

if (!empty($_GET['fmt']) && $_GET['fmt'] == 'json') {
    $response = [];
    try {
        $device_kinds = $pdo->query("SELECT * FROM `device_kind`");
    } catch (PDOException $e) {
        $response['error'] = $e->getMessage();
        echo json_encode($response);
        exit;
    }

    while ($device_kind = $device_kinds->fetch()) {
        $response['device_kinds'][] = $device_kind;
    }
    echo json_encode($response);
    exit;
}

$devices = $pdo->query('SELECT * FROM `device_kind`')->fetchAll();
Database::disconnect();

echo $twig->render('listDeviceKind.html', ['device_kinds' => $devices])
?>
