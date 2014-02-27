<?php

use Rtablada\LiterateRoutes\Parser;

class ParserTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->file = file_get_contents(__DIR__.'/files/route-full.php.md');
		$this->parser = new Parser;
	}

	public function testCompileComment()
	{
		$withComment = '# Comment';
		$noComment = 'Comment';

		$this->assertSame(null, $this->parser->compileComment($noComment));
		$this->assertSame("// Comment\n\n", $this->parser->compileComment($withComment));
	}

	public function testCompileRoutes()
	{
		$tabRoute = "\t@get";
		$spaceRoute = "  @get";
		$noRoute = "@get";

		$this->assertSame("Route::get;\n", $this->parser->compileRoutes($tabRoute));
		$this->assertSame("Route::get;\n", $this->parser->compileRoutes($spaceRoute));
		$this->assertSame(null, $this->parser->compileRoutes($noRoute));
	}

	public function testCompileCodeBlock()
	{
		$tabRoute = "\t@get";
		$spaceRoute = "  @get";
		$noRoute = "@get";

		$this->assertSame("Route::get;\n", $this->parser->compileCodeBlock($tabRoute));
		$this->assertSame("Route::get;\n", $this->parser->compileCodeBlock($spaceRoute));
		$this->assertSame(null, $this->parser->compileCodeBlock($noRoute));
	}

	public function tearDown()
	{
		// your code here
	}
}

