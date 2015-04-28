<?php
require_once('config.php');

if (empty($_GET['instrumentName'])) {
    die('No instrument name specified');
}

echo '<h1>'.htmlspecialchars($_GET['instrumentName']).'</h1>';

echo "<table border=1 >"; 

$get_readings = $db->prepare('SELECT * FROM `instr_' . $_GET['instrumentName'] . '`;');
$get_readings->execute();
$first = true;
while ($reading = $get_readings->fetch()) {
    if ($first) {
        echo '<tr>';
        foreach ($reading as $k => $v) {
            echo "<th>$k</th>"; 
        }
        echo '</tr>';
        $first = false;
    }

    echo '<tr>';
    foreach ($reading as $k => $v) {
        echo "<td>$v</td>"; 
    }
    echo '</tr>';
}
echo '</table>';
echo '<a href="addReading.php?instrumentName='.$_GET['instrumentName'].'">Add a new row</a>'
?>
