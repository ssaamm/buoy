<?php
include('database.php'); 
echo "<table border=1 >"; 
echo "<tr>"; 
echo "<td><b>Id</b></td>"; 
echo "<td><b>Dimension0 Name</b></td>"; 
echo "<td><b>Dimension1 Name</b></td>"; 
echo "<td><b>Device Name</b></td>"; 
echo "</tr>";
$sql = "SELECT * FROM `device_kind`";
$pdo = Database::connect();
foreach($pdo->query($sql) as $row){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['dimension0_name']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['dimension1_name']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['device_name']) . "</td>";  
echo "<td valign='top'><a href=editDeviceKind.php?id={$row['id']}>Edit</a></td><td><a href=deleteDeviceKind.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
Database::disconnect();
echo "</table>"; 
echo "<a href=newDeviceKind.php>New Row</a>"; 
?>