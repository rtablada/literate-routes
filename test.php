<?php

require_once(__DIR__.'/vendor/autoload.php');

$file = new Illuminate\Filesystem\Filesystem;
$parser = new Rtablada\LiterateRoutes\Parser;
$fileParser = new Rtablada\LiterateRoutes\FileParser($file, $parser);
$expected = $file->get(__DIR__.'/tests/files/route-full.php.test');

$fileParser->buildForDirectory(__DIR__.'/tests');
$actual = $file->get(__DIR__.'/tests/files/route-full.php');

if ($expected == $actual) {
	echo "File built correctly.";
} else {
	echo "File build fail.";
}

$file->delete(__DIR__.'/tests/files/route-full.php');
