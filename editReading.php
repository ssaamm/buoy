<? 
include('config.php'); 
if (isset($_GET['device_id']) && isset($_GET['time']) ) { 
$device_id = $_GET['device_id']; 
$time = $_GET['time']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `reading` SET  `device_id` =  '{$_POST['device_id']}' ,  `time` =  '{$_POST['time']}' ,  `dimension0` =  '{$_POST['dimension0']}' ,  `dimension1` =  '{$_POST['dimension1']}'   WHERE  `device_id` = $device_id AND `time` = $time"; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='listReading.php'>Back To Listing</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `reading` WHERE `device_id` = $device_id AND `time` = $time")); 
?>

<form action='' method='POST'> 
<p><b>Device Id:</b><br /><input type='text' name='device_id' value='<?= stripslashes($row['device_id']) ?>' /> 
<p><b>Time:</b><br /><input type='text' name='time' value='<?= stripslashes($row['time']) ?>' /> 
<p><b>Dimension0:</b><br /><input type='text' name='dimension0' value='<?= stripslashes($row['dimension0']) ?>' /> 
<p><b>Dimension1:</b><br /><input type='text' name='dimension1' value='<?= stripslashes($row['dimension1']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
