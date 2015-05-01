<?php
include('database.php'); 
if (isset($_GET['latitude']) && isset($_GET['longitude']) ) { 
$latitude = (int) $_GET['latitude']; 
$longitude = (int) $_GET['longitude']; 
$pdo = Database::connect();
if (isset($_POST['submitted'])) { 
	foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
	$sql = "UPDATE `buoy` SET  `name` =  ? ,  `latitude` =  ? ,  `longitude` =  ? ,  `elevation` =  ? ,  `depth` =  ?   WHERE `latitude` = ?  AND `longitude` = ? "; 

	$q = $pdo->prepare($sql);
	try {
		$q->execute(array($_POST['name'],$_POST['latitude'],$_POST['longitude'],$_POST['elevation'],$_POST['depth'],$latitude,$longitude));
	}catch (PDOException $e){
		die($e->getMessage());
	}
	echo "<a href='listBuoy.php'>Back To Listing</a>"; 
} 
$sql2 = "SELECT * FROM `buoy` WHERE `latitude` = ? AND `longitude` = ? ";

$q = $pdo->prepare($sql2);
try{
	$q->execute(array($latitude,$longitude));
	$row = $q->fetch();
}catch(PDOException $e){
	die($e->getMessage());
}
Database::disconnect();
?>

<form action='' method='POST'> 
<p><b>Name:</b><br /><textarea name='name'><?= stripslashes($row['name']) ?></textarea> 
<p><b>Latitude:</b><br /><input type='text' name='latitude' value='<?= stripslashes($row['latitude']) ?>' /> 
<p><b>Longitude:</b><br /><input type='text' name='longitude' value='<?= stripslashes($row['longitude']) ?>' /> 
<p><b>Elevation:</b><br /><input type='text' name='elevation' value='<?= stripslashes($row['elevation']) ?>' /> 
<p><b>Depth:</b><br /><input type='text' name='depth' value='<?= stripslashes($row['depth']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<?php } ?>