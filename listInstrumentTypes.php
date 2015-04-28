<html>
    <head>
        <title>Instruments</title>
    </head>
    <body>
        <h1>Instruments</h1>
<?php
require_once('config.php');

$show = $db->prepare('SHOW TABLES WHERE `Tables_in_buoy` LIKE \'instr_%\'');
$show->execute();
?>

        <ul>
<?php
while ($table = $show->fetch()) {
    $instr_name = str_replace('instr_', '', $table['Tables_in_buoy']);
    echo '<li>' . $instr_name . ' -- <a href="showReadings.php?instrumentName='.$instr_name.'">';
    echo 'Show readings</a></li>';
}
?>
        </ul>
    </body>
</html>
