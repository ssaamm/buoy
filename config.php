<?php
// connect to db
$link = mysql_connect('localhost', 'yii2buoy', 'pw');
if (!$link) {
    die('Not connected : ' . mysql_error());
}

if (! mysql_select_db('buoy') ) {
    die ('Can\'t use foo : ' . mysql_error());
}
?>
