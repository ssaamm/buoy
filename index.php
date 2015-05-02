<?php
require_once 'twig.php';
require_once 'database.php';

$db = Database::connect();
$buoyCount = $db->query('SELECT COUNT(*) AS buoy_count FROM `buoy`')->fetch()['buoy_count'];
$deviceCount = $db->query('SELECT COUNT(*) AS deviceCount FROM `device`')->fetch()['deviceCount'];
$readingCount = $db->query('SELECT COUNT(*) AS readingCount FROM `reading`')->fetch()['readingCount'];


// the order here corresponds with MySQL's DAYOFWEEK() function
$bars = [
    ['dayOfWeek' => 'SUN', 'value' => '0', 'percentage' => '0'],
    ['dayOfWeek' => 'MON', 'value' => '0', 'percentage' => '0'],
    ['dayOfWeek' => 'TUE', 'value' => '0', 'percentage' => '0'],
    ['dayOfWeek' => 'WED', 'value' => '0', 'percentage' => '0'],
    ['dayOfWeek' => 'THU', 'value' => '0', 'percentage' => '0'],
    ['dayOfWeek' => 'FRI', 'value' => '0', 'percentage' => '0'],
    ['dayOfWeek' => 'SAT', 'value' => '0', 'percentage' => '0'],
];

$readingCounts = $db->query('SELECT DAYOFWEEK(time) AS dayOfWeek, COUNT(*) as count ' .
    'FROM buoy.reading '.
    'WHERE time BETWEEN DATE_SUB(NOW(), INTERVAL 1 WEEK) AND NOW() '.
    'GROUP BY DAYOFWEEK(time);');
$counts = [];
while ($count = $readingCounts->fetch()) {
    $bars[$count['dayOfWeek'] - 1]['value'] = $count['count'];
}

foreach ($bars as $bar) {
    $counts[] = (int) $bar['value'];
}

$max = max($counts);
$min = min($counts);

if (count($counts) <= 0) {
    $max = 10;
    $min = 0;
}

$labels = [];
for ($i = 5; $i >= 0; $i--) {
    $labels[] = number_format($min + (($max - $min) / 5) * $i, 2);
}

if ($max - $min > 0) {
    for ($i = 0; $i < count($bars); $i++) {
        $bar = $bars[$i];
        $bars[$i]['percentage'] = 100 * ($bar['value'] - $min) / ($max - $min);
    }
}

$lakeWacoTemp = $db->query('SELECT AVG(r.dimension0) AS average '.
'FROM reading r, device d, buoy_device bd, buoy b '.
'WHERE r.device_id = d.id '.
'    AND r.time BETWEEN DATE_SUB(NOW(), INTERVAL 1 WEEK) AND NOW() '.
'    AND d.device_type = 3 '.
'    AND r.device_id = bd.device_id '.
'    AND bd.latitude = b.latitude '.
'    AND bd.longitude = b.longitude '.
'    AND LOWER(name) LIKE \'%lake waco%\';')->fetch();

$lakeWhitneyTemp = $db->query('SELECT AVG(r.dimension0) AS average '.
'FROM reading r, device d, buoy_device bd, buoy b '.
'WHERE r.device_id = d.id '.
'    AND r.time BETWEEN DATE_SUB(NOW(), INTERVAL 1 WEEK) AND NOW() '.
'    AND d.device_type = 3 '.
'    AND r.device_id = bd.device_id '.
'    AND bd.latitude = b.latitude '.
'    AND bd.longitude = b.longitude '.
'    AND LOWER(name) LIKE \'%lake whitney%\';')->fetch();

$brazosRiverTemp = $db->query('SELECT AVG(r.dimension0) AS average '.
'FROM reading r, device d, buoy_device bd, buoy b '.
'WHERE r.device_id = d.id '.
'    AND r.time BETWEEN DATE_SUB(NOW(), INTERVAL 1 WEEK) AND NOW() '.
'    AND d.device_type = 3 '.
'    AND r.device_id = bd.device_id '.
'    AND bd.latitude = b.latitude '.
'    AND bd.longitude = b.longitude '.
'    AND LOWER(name) LIKE \'%brazos river%\';')->fetch();

$temps = [
    'lakeWaco' => number_format($lakeWacoTemp['average'], 1),
    'lakeWhitney' => number_format($lakeWhitneyTemp['average'], 1),
    'brazosRiver' => number_format($brazosRiverTemp['average'], 1),
];

Database::disconnect();

echo $twig->render('dashboard.html', ['buoyCount' => $buoyCount, 'deviceCount' => $deviceCount, 'readingCount' => $readingCount, 'labels' => $labels, 'bars' => $bars, 'temps' => $temps]);
?>
