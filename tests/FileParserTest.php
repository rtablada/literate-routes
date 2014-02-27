<?php


use Illuminate\Filesystem\Filesystem;
use Rtablada\LiterateRoutes\Parser;
use Rtablada\LiterateRoutes\FileParser;

class FileParserTest extends PHPUnit_Framework_TestCase
{
	public function __construct()
	{
		$this->fileInPath = __DIR__.'/files/route-full.php.md';
		$this->fileOut = file_get_contents(__DIR__.'/files/route-full.php.test');
	}

	public function setUp()
	{
		$this->parser = new FileParser(new Filesystem, new Parser);
	}

	public function testCompile()
	{
		echo "\n\n\n".$this->fileOut;
		echo "\n\n\n".$this->parser->compile($this->fileInPath);

		$this->assertSame($this->fileOut, $this->parser->compile($this->fileInPath));
	}
}

