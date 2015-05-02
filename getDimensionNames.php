<?php
require_once 'database.php';
$pdo = Database::connect();
$response = ['dimension0name' => 'Dimension0', 'dimension1name' => 'Dimension1'];
try {
    $dimensions = $pdo->prepare('SELECT dimension0_name, dimension1_name ' .
        'FROM device d, device_kind dk ' .  
        'WHERE d.device_type = dk.id AND d.id = :device_id;');
    $dimensions->bindValue(':device_id', $_GET['deviceId']);
    $dimensions->execute();
    $result = $dimensions->fetch();
    if ($result != false) {
        $response['dimension0name'] = $result['dimension0_name'];
        $response['dimension1name'] = empty($result['dimension1_name']) ? null : $result['dimension1_name'];
    }
} catch (PDOException $e) {
    $response['error'] = $e->getMessage();
    echo json_encode($response);
    exit;
}
Database::disconnect();

echo json_encode($response);
?>
