<? 
include('config.php'); 
echo "<table border=1 >"; 
echo "<tr>"; 
echo "<td><b>Device Id</b></td>"; 
echo "<td><b>Time</b></td>"; 
echo "<td><b>Dimension0</b></td>"; 
echo "<td><b>Dimension1</b></td>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `reading`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = htmlspecialchars($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['device_id']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['time']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['dimension0']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['dimension1']) . "</td>";  
echo "<td valign='top'><a href=editReading.php?device_id={$row['device_id']}'&time={$row['time']}>Edit</a></td><td><a href='deleteReading.php?device_id={$row['device_id']}&time={$row['time']}'>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=newReading.php>New Row</a>"; 
?>
