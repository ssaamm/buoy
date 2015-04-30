<? 
include('config.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `device_kind` ( `dimension0_name` ,  `dimension1_name` ,  `device_name`  ) VALUES(  '{$_POST['dimension0_name']}' ,  '{$_POST['dimension1_name']}' ,  '{$_POST['device_name']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
echo "Added row.<br />"; 
echo "<a href='listDeviceKind.php'>Back To Listing</a>"; 
} 
?>

<form action='' method='POST'> 
<p><b>Dimension0 Name:</b><br /><input type='text' name='dimension0_name'/> 
<p><b>Dimension1 Name:</b><br /><input type='text' name='dimension1_name'/> 
<p><b>Device Name:</b><br /><input type='text' name='device_name'/> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
