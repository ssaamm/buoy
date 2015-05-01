<?php
include('database.php'); 
$id = (int) $_GET['id']; 
$sql = "DELETE FROM `device_kind` WHERE `id` = ? "; 
$pdo = Database::connect();
$q = $pdo->prepare($sql);
$q->execute(array($id));

Database::disconnect();
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='listDeviceKind.php'>Back To Listing</a>