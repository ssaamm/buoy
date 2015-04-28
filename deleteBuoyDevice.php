<? 
include('config.php'); 
$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];
$device_id = (int) $_GET['device_id']; 
mysql_query("DELETE FROM `buoy_device` WHERE `latitude` = $latitude AND " .
    "`longitude` = $longitude AND `device_id` = $device_id;") ; 
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='listBuoyDevice.php'>Back To Listing</a>
