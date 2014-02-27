<?php namespace Rtablada\LiterateRoutes;

class Parser
{
	protected $controller;

	protected $asNamespace;

	public function compileString($string, $newFile = false)
	{
		$parts = preg_split('/[\n\r]{2}/', $string);
		$return = '';

		foreach ($parts as $part) {
			$return .= $this->compileComment($part);
			$return .= $this->compileCodeBlock($part);
		}
		$return = $newFile ? "<?php\n\n" . $return : $return;

		return "<?php\n\n" . $return;
	}

	public function compileComment($string)
	{
		$matches = array();

		if (preg_match('/#(.*)/', $string, $matches)) {
			return "//{$matches[1]}\n\n";
		}
	}

	public function compileCodeBlock($string)
	{
		if (preg_match('/^[(\s\s)\t]+@/', $string)) {
			return $this->compileRoutes($string);
		}
	}

	public function compileRoutes($string)
	{
		preg_match_all('/\n?[(\s\s)\t]+@(.*)(;)?/', $string, $matches, PREG_SET_ORDER);
		$return = null;

		foreach ($matches as $match) {
			$matches = array();

			$return .= "Route::{$match[1]};\n";
		}

		return $return;
	}
}
