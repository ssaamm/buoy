<? 
include('config.php'); 
echo "<table border=1 >"; 
echo "<tr>"; 
echo "<td><b>Id</b></td>"; 
echo "<td><b>Dimension0 Name</b></td>"; 
echo "<td><b>Dimension1 Name</b></td>"; 
echo "<td><b>Device Name</b></td>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `device_kind`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['dimension0_name']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['dimension1_name']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['device_name']) . "</td>";  
echo "<td valign='top'><a href=editDeviceKind.php?id={$row['id']}>Edit</a></td><td><a href=deleteDeviceKind.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=newDeviceKind.php>New Row</a>"; 
?>