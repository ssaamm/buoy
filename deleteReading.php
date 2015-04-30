<? 
include('config.php'); 
$device_id = $_GET['device_id']; 
$time = $_GET['time']; 
mysql_query("DELETE FROM `reading` WHERE `device_id` = $device_id AND `time` = $time") ; 
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='listReading.php'>Back To Listing</a>
