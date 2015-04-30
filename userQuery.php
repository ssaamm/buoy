<?
require_once 'twig.php';

$url_parts = explode('/', $_SERVER['REQUEST_URI']);
$url = 'http://' . $_SERVER['HTTP_HOST'];
for ($i = 0; $i < count($url_parts) - 1; $i++) {
    if (empty($url_parts[$i])) { continue; }
    $url .= '/' . $url_parts[$i];
}
$url .= '/listBuoy.php?fmt=json';

$buoys = json_decode(file_get_contents($url));
$buoys = $buoys->buoys;
echo $twig->render('userQuery.html', ['buoys' => $buoys]);
?>
