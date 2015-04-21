<? 
include('config.php'); 
echo "<table border=1 >"; 
echo "<tr>"; 
echo "<td><b>Name</b></td>"; 
echo "<td><b>Latitude</b></td>"; 
echo "<td><b>Longitude</b></td>"; 
echo "<td><b>Elevation</b></td>"; 
echo "<td><b>Depth</b></td>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `buoy`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
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
echo "</table>"; 
echo "<a href=newBuoy.php>New Row</a>"; 
?>
