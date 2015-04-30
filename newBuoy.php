<? 
include('database.php'); 
if (isset($_POST['submitted'])) { 

foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `buoy` ( `name` ,  `latitude` ,  `longitude` ,  `elevation` ,  `depth`  ) VALUES( ? , ? , ? , ? , ?  ) "; 

$pdo = Database::connect();
$q = $pdo->prepare($sql);
try {
	$q->execute(array($_POST['name'],$_POST['latitude'],$_POST['longitude'],$_POST['elevation'],$_POST['depth']));
}catch(PDOException $e){
	die($e)
}
Database::disconnect();
echo "Added row.<br />"; 
echo "<a href='listBuoy.php'>Back To Listing</a>"; 
} 
?>

<form action='' method='POST'> 
<p><b>Name:</b><br /><textarea name='name'></textarea> 
<p><b>Latitude:</b><br /><input type='text' name='latitude'/> 
<p><b>Longitude:</b><br /><input type='text' name='longitude'/> 
<p><b>Elevation:</b><br /><input type='text' name='elevation'/> 
<p><b>Depth:</b><br /><input type='text' name='depth'/> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
