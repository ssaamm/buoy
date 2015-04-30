<?
require_once 'twig.php';

$buoys = json_decode(file_get_contents('http://localhost/buoy/listBuoy.php?fmt=json'));
$buoys = $buoys->buoys;
echo $twig->render('userQuery.html', ['buoys' => $buoys]);
?>
