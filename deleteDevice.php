<?php
include('database.php'); 
$id = (int) $_GET['id']; 
$sql = "DELETE FROM `device` WHERE `id` = ? ";
$pdo = Database::connect();
$q = $pdo->prepare($sql);
try {
	$q->execute(array($id));
}catch (PDOException $e){
	die($e->getMessage());
}

Database::disconnect();
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='listDevice.php'>Back To Listing</a>