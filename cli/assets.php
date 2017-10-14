<?php

$dir = __DIR__ . '/../assets';

$files = (object) [
	'dev' => [
		'scripts' => [
			'/js/bundle.js' => '/js/bundle.js'
		],
		'styles' => [
			'/css/bundle.css' => '/css/bundle.min.css'
		]
	],
	'live' => [
		'scripts' => [
			'/js/bundle.min.js' => '/js/bundle.{time}.min.js'
		],
		'styles' => [
			'/css/bundle.css' => '/css/bundle.{time}.min.css'
		]
	]
];

$clear = [
	'/js/bundle.*.min.js',
	'/css/bundle.*.min.css'
];

foreach ($clear as $pattern) {
	foreach (glob($dir . $pattern) as $file) {
		unlink($file);
	}
}

$config = [];

foreach ($files as $set => $arr) {
	$config[$set] = [];
	foreach ($arr as $ns => $items) {
		$config[$set][$ns] = [];
		foreach ($items as $from => $to) {
			$file = $dir . $from;
			$time = filemtime($file);
			$time = base_convert($time, 10, 36);
			$to = str_replace('{time}', $time, $to);

			copy($file, $dir . $to);

			$config[$set][$ns][] = '/assets' . $to;
			printf("%s => %s\n", $from, $to);
		}
	}
}

file_put_contents($dir . '/config.json', json_encode($config, JSON_PRETTY_PRINT));