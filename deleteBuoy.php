<? 
include('database.php'); 
$latitude = (int) $_GET['latitude']; 
$longitude = (int) $_GET['longitude']; 
$sql = "DELETE FROM `buoy` WHERE `latitude` = ? AND `longitude` = ? ";
$pdo = Database::connect();
$q = $pdo->prepare($sql);
try{
	$q -> execute(array($latitude, $longitude));
}catch(PDOException $e){
	die($e->getMessage());
}
mysql_query("DELETE FROM `buoy` WHERE `latitude` = '$latitude' AND `longitude` = '$longitude' ") ; 
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='listBuoy.php'>Back To Listing</a>
