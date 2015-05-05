<?php
	
	require_once 'database.php';
	$yearStr = "year";
	$monthStr = "month";
	$weekStr = "week";
	$dayStr = "day";


	if(isset($_GET['device_name'])){
		$pdo = Database::connect();
		$device_id = $_GET['device_name'];

		$latitude = $_GET['latitude'];
		$longitude = $_GET['longitude'];
		$range = isset($_GET['range'])  ? $_GET['range'] : 5;
		$oldestTime = "day";
		$divisionTime = "date";
		switch($_GET['period']){
			case $yearStr:
				$oldestTime = "year";
				$divisionTime = "month";
				break;
			case $monthStr:
				$oldestTime = "month";
				$divisionTime = "date";
				break;
			case $weekStr:
				$oldestTime = "week";
				$divisionTime = "date";
				break;
			default:
				$oldestTime = "day";
				break;
		}
		$reading_sql = "SELECT ".$divisionTime."(a.time) as month,AVG(a.dimension0) as d0Avg,AVG(a.dimension1) as d1Avg FROM reading as a, buoy_device WHERE
			 ((acos(sin((?*pi()/180)) * sin((buoy_device.`Latitude`*pi()/180))+cos((?*pi()/180)) * cos((buoy_device.`Latitude`*pi()/180)) * cos(((?- buoy_device.`Longitude`)*pi()/180))))*180/pi())*60*1.1515 <= ? 
			AND a.device_id = buoy_device.device_id
			AND a.time >  curdate() - interval 1 ".$oldestTime."
			AND
			EXISTS ( 
				SELECT * FROM device WHERE a.device_id = id AND device_type = ?)
			GROUP BY ".$divisionTime."(a.time)
			ORDER BY ".$divisionTime."(a.time)
				";
		$response = ['readings' => []];
		
		$q = $pdo->prepare($reading_sql);
		try{
			$q->execute(array($latitude,$latitude,$longitude,$range,$device_id));
			
			while ($reading = $q->fetch()) {
    	    	
    	    	$response['readings'][] = $reading;
    		}
		}catch(PDOException $e){
			 $response = ['error' => true, 'message' => $e->getMessage()];
		}
		 
    

		Database::disconnect();
		echo json_encode($response);
	}

?>