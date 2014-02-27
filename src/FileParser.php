<?php namespace Rtablada\LiterateRoutes;

use Illuminate\Filesystem\Filesystem;

class FileParser
{
	public function __construct(Filesystem $file, Parser $parser)
	{
		$this->file = $file;
		$this->parser = $parser;
	}

	public function compile($path)
	{
		$string = $this->file->get($path);

		return $this->parser->compileString($string);
	}

	public function build($path)
	{
		$matches = array();

		if (preg_match('/(.*)(?:\.php\.md)|(?:\.litphp)/', $path, $matches)) {
			$outPath = $matches[1].'.php';
			$result = $this->compile($path);

			$this->file->put($outPath, $result);
		}
	}
}