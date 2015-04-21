<? 
include('config.php'); 
$latitude = (int) $_GET['latitude']; 
$longitude = (int) $_GET['longitude']; 
mysql_query("DELETE FROM `buoy` WHERE `latitude` = '$latitude' AND `longitude` = '$longitude' ") ; 
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='listBuoy.php'>Back To Listing</a>
