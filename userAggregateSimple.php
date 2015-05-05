<?php
	
	include_once 'database.php';
	$yearStr = "year";
	$monthStr = "month";
	$weekStr = "week";
	$dayStr = "day";


	if(isset($_POST['device_name'])){
		$pdo = Database::connect();
		$device_id = $_POST['device_name'];

		$latitude = $_POST['latitude'];
		$longitude = $_POST['longitude'];
		$range = $_POST['range'];
		$oldestTime = "day";
		switch($_POST['period']){
			case $yearStr:
				$oldestTime = "year";
				break;
			case $monthStr:
				$oldestTime = "month";
				break;
			case $weekStr:
				$oldestTime = "week";
				break;
			default:
				$oldestTime = "day";
				break;
		}
		$reading_sql = "SELECT * FROM reading as a, buoy_device WHERE
			 ((acos(sin((?*pi()/180)) * sin((buoy_device.`Latitude`*pi()/180))+cos((?*pi()/180)) * cos((buoy_device.`Latitude`*pi()/180)) * cos(((?- buoy_device.`Longitude`)*pi()/180))))*180/pi())*60*1.1515 <= ? 
			AND a.device_id = buoy_device.device_id
			AND a.time >  curdate() - interval 1 ".$oldestTime."
			AND
			EXISTS ( 
				SELECT * FROM device WHERE a.device_id = id AND device_type = ?)
				
				";
		
		$q = $pdo->prepare($reading_sql);
		try{
			$q->execute(array($latitude,$latitude,$longitude,$range,$device_id));
			echo "executing<br />";
			
		}catch(PDOException $e){
			echo "there was an error. please try again";
		}
		foreach($q->fetchAll() as $tuple){
			echo print_r($tuple)."<br />";
		}

		Database::disconnect();


	}

?>
<html>
<head>
	<style type="text/css">
	#input{
		float:left;
	}
	#graph{
		float:right;
	}
	</style>
</head>
<body>

<div id="input">
	<form method="POST" action="userAggregate.php">
	<select name="device_name">
		<?php
			require_once 'database.php';
			$sql = "SELECT id,device_name FROM device_kind";
			$pdo = Database::connect();
			try{
				$deviceList = $pdo->query($sql);
			}catch(PDOException $e){
				die($e->getMessage());
			}
			foreach($deviceList as $name){
				
				echo "<option value=\"".$name['id']."\">".$name['device_name']."</option>";
			}
			Database::disconnect();
		?>
	</select><br />
	<label>Longitude: </label><input type="text" name="longitude" /><br />
	<label>Latitude: </label><input type="text" name="latitude" /><br />
	<label>Range: </label><input type="text" name="range" /><br />
	<label>History to Examine</label>
	<select name="period">
		<option value="<?php echo $yearStr;?>">Year</option>
		<option value="<?php echo $monthStr;?>">Month</option>
		<option value="<?php echo $weekStr;?>">Week</option>
	</select><br />
	<label>Frequency of sampling</label>
	<select name="frequency">
		<option value="<?php echo $monthStr;?>">Month</option>
		<option value="<?php echo $weekStr;?>">Week</option>
		<option value="<?php echo $dayStr;?>">Day</option>
	</select><br />
	<input type="submit" value="Find Data" />
	</form>
</div>

<div id="graph">
	graph
</div>

</body>
</html>