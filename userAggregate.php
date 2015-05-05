<?php
require_once 'twig.php';

$url_parts = explode('/', $_SERVER['REQUEST_URI']);
$url = 'http://' . $_SERVER['HTTP_HOST'];
for ($i = 0; $i < count($url_parts) - 1; $i++) {
    if (empty($url_parts[$i])) { continue; }
    $url .= '/' . $url_parts[$i];
}
$buoy_url = $url.'/listBuoy.php?fmt=json';
$device_kind_url = $url.'/listDeviceKind.php?fmt=json';

$buoys = json_decode(file_get_contents($buoy_url));
$buoys = $buoys->buoys;
$device_kinds = json_decode(file_get_contents($device_kind_url));
$device_kinds = $device_kinds->device_kinds;

echo $twig->render('userAggregate.html', ['buoys' => $buoys, 'device_kinds' => $device_kinds]);
?>