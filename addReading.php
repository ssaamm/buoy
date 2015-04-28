<?php
require_once('config.php');

if (empty($_GET['instrumentName'])) {
    die('Error: no instrument specified');
}

$get_cols = $db->prepare('SHOW columns FROM `instr_' . $_GET['instrumentName'] . '`;');
$get_cols->execute();
$cols = array();
while ($row = $get_cols->fetch()) {
    $cols[] = $row['Field'];
}

if (isset($_POST['submitted'])) { 
    $query = 'INSERT INTO `instr_' . $_GET['instrumentName'] . '` (';
    $first = true;
    foreach ($cols as $col) {
        if ($first) {
            $first = false;
        } else {
            $query .= ',' . PHP_EOL;
        }
        $query .= "`$col`";
    }
    $query .= ') VALUES (';

    $first = true;
    foreach($cols as $col) {
        if ($first) {
            $first = false;
        } else {
            $query .= ',' . PHP_EOL;
        }
        $query .= '\'' . $_POST[$col] . '\'';
    }
    $query .= ');';

    echo $query;

    $num_rows = $db->exec($query);
    if ($num_rows > 0) {
        echo "Inserted row";
    } else {
        echo "Did not instert row";
    }
}

echo "<form action='' method='POST'>";

foreach ($cols as $col) {
    echo "<p>" . $col . "<br><input type='text' name='$col'></p>";
}
?>
<input type='hidden' value='1' name='submitted' /> 
<input type="submit" value="Add reading">
</form>
