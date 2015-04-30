<? 
include('config.php'); 
$id = (int) $_GET['id']; 
mysql_query("DELETE FROM `device_kind` WHERE `id` = '$id' ") ; 
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='listDeviceKind.php'>Back To Listing</a>