<?php
/*
 * Parameters:
 * - To query by time:
 *   - startTime
 *   - endTime
 * - To query by device:
 *   - deviceId
 * - To query by buoy:
 *   - latitude
 *   - longitude
 *
 * - If dl is set to 1, it will prompt for download
 * - If dl is set to 2, it will be a MATLAB export
 *
 * If you don't get all the attributes to query by a certain criterion, that 
 * criterion will be ignored.
 *
 * Query parameters can be mixed and matched
 *
 * Return: a JSON object. If there's an error, the attribute 'error' will be set
 * to true, and the attribute 'message' may have a useful message. Otherwise, 
 * results of the query are included in an array on the 'readings' attribute.
 *
 */

require_once('database.php');

function shouldQueryOnDeviceId() {
    return !empty($_GET['deviceId']);
}

function shouldQueryOnBuoy() {
    return !empty($_GET['latitude']) && !empty($_GET['longitude']);
}

function shouldQueryOnTime() {
    return !empty($_GET['startTime']) && !empty($_GET['endTime']);
}

function shouldQuery() {
    return shouldQueryOnDeviceId() || shouldQueryOnBuoy() || shouldQueryOnTime();
}

$query = 'SELECT r.device_id, time, dimension0, dimension1' .
   ' FROM reading r';
$response = ['readings' => []];

if (shouldQueryOnBuoy()) {
    $query .= ', buoy_device bd WHERE r.device_id = bd.device_id AND '
        . '`latitude` = :latitude AND `longitude` = :longitude';
} else if (shouldQuery()) {
    $query .= ' WHERE ';
}

if (shouldQueryOnDeviceId()) {
    if (shouldQueryOnBuoy()) {
        $query .= ' AND ';
    }
    $query .= 'r.`device_id` = :device_id';
}

if (shouldQueryOnTime()) {
    if (shouldQueryOnDeviceId() || shouldQueryOnBuoy()) {
        $query .= ' AND ';
    }
    $query .= '`time` >= :start_time AND `time` <= :end_time';
}

$pdo = Database::connect();
$get_readings = $pdo->prepare($query);
if (shouldQueryOnDeviceId()) {
    $get_readings->bindValue(':device_id', $_GET['deviceId']);
}
if (shouldQueryOnBuoy()) {
    $get_readings->bindValue(':longitude', $_GET['longitude']);
    $get_readings->bindValue(':latitude', $_GET['latitude']);
}
if (shouldQueryOnTime()) {
    $get_readings->bindValue(':start_time', $_GET['startTime']);
    $get_readings->bindValue(':end_time', $_GET['endTime']);
}

try {
    $get_readings->execute();
    while ($reading = $get_readings->fetch()) {
        $response['readings'][] = $reading;
    }
} catch (PDOException $e) {
    $response = ['error' => true, 'message' => $e->getMessage()];
}

Database::disconnect();

if (isset($_GET['dl'])) {
    if ($_GET['dl'] == 1) {
        $fn = 'export.csv';
        header('Content-Disposition: attachment; filename="' . $fn . '"');

        $stdout = fopen('php://output', 'w');
        fputcsv($stdout, ['Device ID', 'Time', 'Dimension0', 'Dimension1']);
        foreach ($response['readings'] as $reading) {
            fputcsv($stdout, $reading);
        }
        fflush($stdout);
        fclose($stdout);
    } elseif ($_GET['dl'] == 2) {
        $fn = 'export.m';
        header('Content-Disposition: attachment; filename="' . $fn . '"');
        echo 'readings = [];' . PHP_EOL;
        foreach ($response['readings'] as $reading) {
            $matlabFmtReading = 'struct(';
            $first = true;
            foreach ($reading as $k => $v) {
                if ($first) { $first = false; }
                else { $matlabFmtReading .= ','; }
                $matlabFmtReading .= "'$k'" . ',' . "'$v'";
            }
            $matlabFmtReading .= ')';
            echo 'readings = [readings ' . $matlabFmtReading . '];' . PHP_EOL;
        }
    }
    exit;
}
echo json_encode($response);

?>
