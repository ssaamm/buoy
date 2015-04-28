<?php
include('config.php');

/*
 * POST form data to this script
 *
 * - instrumentName is the name of the instrument
 * - attribute0, attribute1, attribute2, ... are the names of each attribute
 * - each attribute is expected to be accompanied by an attributeNtype
 *   - attributeNtype should be either 'int' or 'float'
 *
 * example: 
 * instrumentName=fake_instrument&attribute0=temperature&attribute0type=int&attribute1=weight&attribute1type=float
 */

if (empty($_POST['instrumentName'])) {
    die('Error: no instrument name');
}

$attributes = array();
$attribute_types = array();
$i = 0;
while (!empty($_POST['attribute' . $i])) {
    $attributes[] = $_POST['attribute' . $i];

    $attribute_type = 'int(11)';
    if ($_POST['attribute' . $i . 'type'] == 'float') {
        $attribute_type = 'decimal(18,12)';
    }
    $attribute_types[$i] =  $attribute_type;

    $i += 1;
}

if (count($attributes) < 1 || count($attributes) != count($attribute_types)) {
    die('Error in number of attributes');
}

$query = 'CREATE TABLE `instr_' . $_POST['instrumentName'] . '` (
    `device_id` int(11) NOT NULL,
    `time` DATETIME NOT NULL,' . PHP_EOL;

for ($i = 0; $i < count($attributes); ++$i) {
    $query .= '    `' . $attributes[$i] . '` ' . $attribute_types[$i] . ' NOT NULL,' . PHP_EOL;
}

$query .= '    PRIMARY KEY (`device_id`,`time`),
    CONSTRAINT fk_' . $_POST['instrumentName'] . ' FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;';

$db->exec($query);
?>
