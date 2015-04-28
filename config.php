<?php
// connect to db
$link = mysql_connect('localhost', 'yii2buoy', 'pw');
if (!$link) {
    die('Not connected : ' . mysql_error());
}

if (! mysql_select_db('buoy') ) {
    die ('Can\'t use foo : ' . mysql_error());
}

try {
    $db = new PDO('mysql:host=localhost;dbname=buoy', 'yii2buoy', 'pw');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}
?>
