<? 
include('config.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `buoy_device` ( `latitude` ,  `longitude` ,  `device_id`  ) VALUES(  '{$_POST['latitude']}' ,  '{$_POST['longitude']}' ,  '{$_POST['device_id']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
echo "Added row.<br />"; 
echo "<a href='listBuoyDevice.php'>Back To Listing</a>"; 
} 
?>

<form action='' method='POST'> 
<p><b>Latitude:</b><br /><input type='text' name='latitude'/> 
<p><b>Longitude:</b><br /><input type='text' name='longitude'/> 
<p><b>Device Id:</b><br /><input type='text' name='device_id'/> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
