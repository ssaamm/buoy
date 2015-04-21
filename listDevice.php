<? 
include('config.php'); 
echo "<table border=1 >"; 
echo "<tr>"; 
echo "<td><b>Id</b></td>"; 
echo "<td><b>Device Type</b></td>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `device`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['device_type']) . "</td>";  
echo "<td valign='top'><a href=editDevice.php?id={$row['id']}>Edit</a></td><td><a href=deleteDevice.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=newDevice.php>New Row</a>"; 
?>