<? 
include('config.php'); 
if (isset($_GET['latitude']) && isset($_GET['longitude']) && isset($_GET['device_id'])) { 
$latitude = $_GET['latitude']; 
$longitude = $_GET['longitude']; 
$device_id = (int) $_GET['device_id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `buoy_device` SET  `latitude` =  '{$_POST['latitude']}' ,  `longitude` =  '{$_POST['longitude']}' ,  `device_id` =  '{$_POST['device_id']}'  " .
    "WHERE `latitude` = $latitude AND `longitude` = $longitude AND `device_id` = $device_id"; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='listBuoyDevice.php'>Back To Listing</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `buoy_device` WHERE `latitude` = $latitude AND `longitude` = $longitude AND `device_id` = $device_id")); 
?>

<form action='' method='POST'> 
<p><b>Latitude:</b><br /><input type='text' name='latitude' value='<?= stripslashes($row['latitude']) ?>' /> 
<p><b>Longitude:</b><br /><input type='text' name='longitude' value='<?= stripslashes($row['longitude']) ?>' /> 
<p><b>Device Id:</b><br /><input type='text' name='device_id' value='<?= stripslashes($row['device_id']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
