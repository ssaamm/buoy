<? 
include('config.php'); 
if (isset($_GET['latitude']) && isset($_GET['longitude']) ) { 
$latitude = (int) $_GET['latitude']; 
$longitude = (int) $_GET['longitude']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `buoy` SET  `name` =  '{$_POST['name']}' ,  `latitude` =  '{$_POST['latitude']}' ,  `longitude` =  '{$_POST['longitude']}' ,  `elevation` =  '{$_POST['elevation']}' ,  `depth` =  '{$_POST['depth']}'   WHERE `latitude` = '$latitude'  AND `longitude` = '$longitude' "; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='listBuoy.php'>Back To Listing</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `buoy` WHERE `latitude` = '$latitude' AND `longitude` = '$longitude' ")); 
?>

<form action='' method='POST'> 
<p><b>Name:</b><br /><textarea name='name'><?= stripslashes($row['name']) ?></textarea> 
<p><b>Latitude:</b><br /><input type='text' name='latitude' value='<?= stripslashes($row['latitude']) ?>' /> 
<p><b>Longitude:</b><br /><input type='text' name='longitude' value='<?= stripslashes($row['longitude']) ?>' /> 
<p><b>Elevation:</b><br /><input type='text' name='elevation' value='<?= stripslashes($row['elevation']) ?>' /> 
<p><b>Depth:</b><br /><input type='text' name='depth' value='<?= stripslashes($row['depth']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
