<? 
include('config.php'); 
echo "<table border=1 >"; 
echo "<tr>"; 
echo "<td><b>Latitude</b></td>"; 
echo "<td><b>Longitude</b></td>"; 
echo "<td><b>Device Id</b></td>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `buoy_device`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['latitude']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['longitude']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['device_id']) . "</td>";  
echo "<td valign='top'><a href=editBuoyDevice.php?latitude={$row['latitude']}&longitude={$row['longitude']}&device_id={$row['device_id']}>Edit</a></td><td><a href=deleteBuoyDevice.php?latitude={$row['latitude']}&longitude={$row['longitude']}&device_id={$row['device_id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=newBuoyDevice.php>New Row</a>"; 
?>
