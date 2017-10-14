<?php

include_once __DIR__ . '/vendor/autoload.php';

if (!defined('LIVE_MODE')) {
	define('LIVE_MODE', false);
}

$uri  = $_SERVER['REQUEST_URI'];
if ('/' == $uri) {
	$uri = '/index';
}
$file = str_replace('/', DIRECTORY_SEPARATOR, rtrim($uri, '/')) . '.pug';
$dir  = __DIR__ . DIRECTORY_SEPARATOR . 'templates';
if (!file_exists($dir . $file)) {
	$file = DIRECTORY_SEPARATOR . '404.pug';
}
$file = $dir . $file;

$data = [];
$json = json_decode(file_get_contents(__DIR__ . '/assets/config.json'));
$data['config'] = LIVE_MODE ? $json->live : $json->dev;

$pug = new Pug\Pug(
	[
		'pretty' => !((bool) LIVE_MODE)
	]
);
$html = $pug->render($file, $data);


if (!headers_sent()) {
	header('Content-Type: text/html; charset=utf-8');
}
echo $html;