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
    	$this->assertSame('// Comment', $this->parser->compileComment($withComment));
    }

    public function tearDown()
    {
        // your code here
    }
}

