<?php

function compileUrl($url) {
	$_SERVER['REQUEST_URI'] = $url;
	ob_start();
	include(__DIR__ . '/../index.php');
	$html = ob_get_contents();
	ob_end_clean();
	return $html;
}

$templatesDir = __DIR__ . '/../templates';

$Directory = new RecursiveDirectoryIterator($templatesDir);
$Iterator = new RecursiveIteratorIterator($Directory);
$Regex = new RegexIterator($Iterator, '/^.+\.pug$/i', RecursiveRegexIterator::GET_MATCH);

$files = [];
foreach ($Regex as $arr) {
	foreach ($arr as $file) {
		if (preg_match('/[\/]_/', $file)) {
			continue;
		}
		$url = str_replace($templatesDir, '', $file);
		$res = preg_replace('/\.pug$/', '.html', $url);
		$url = preg_replace('/\.pug$/', '', $url);
		if ('/index' == $url) {
			$url = '/';
		}
		$files[$url] = __DIR__ . '/../compiled' . $res;
	}
}

define('LIVE_MODE', true);

printf("Compiling %d files:\n", count($files));

foreach ($files as $url => $file) {
	file_put_contents($file, compileUrl($url));
	printf("  %-20s > %s\n", $url, preg_replace('/.+\/compiled\//', 'compiled/', $file));
}
print("Complete\n");
