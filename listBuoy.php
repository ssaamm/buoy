<?php
include 'database.php'; 

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

echo "<table border=1 >"; 
echo "<tr>"; 
echo "<td><b>Name</b></td>"; 
echo "<td><b>Latitude</b></td>"; 
echo "<td><b>Longitude</b></td>"; 
echo "<td><b>Elevation</b></td>"; 
echo "<td><b>Depth</b></td>"; 
echo "</tr>"; 
$sql = "SELECT * FROM `buoy`";
foreach($pdo->query($sql) as $row){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['name']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['latitude']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['longitude']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['elevation']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['depth']) . "</td>";  
echo "<td valign='top'><a href=editBuoy.php?latitude={$row['latitude']}&longitude={$row['longitude']}>Edit</a></td><td><a href=deleteBuoy.php?latitude={$row['latitude']}&longitude={$row['longitude']}>Delete</a></td> "; 
echo "</tr>"; 
} 
Database::disconnect();
echo "</table>"; 
echo "<a href=newBuoy.php>New Row</a>"; 
?>
