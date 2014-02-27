<?php namespace Rtablada\LiterateRoutes;

class Parser
{
	public function compileString($string)
	{
		$parts = preg_split('/[\n\r]{2}/', $string);
		$return = '';

		foreach ($parts as $part) {
			$return .= $this->compileComment($part);
			$return .= $this->compileCodeBlock($part);
		}

		return $return;
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
		$lines = explode("\n", $string);
		$return = null;

		foreach ($lines as $line) {
			$matches = array();

			if (preg_match('/^[(\s\s)\t]+@(.*)(;)?/', $line, $matches)) {
				$return .= "Route::{$matches[1]};\n";
			}
		}

		return $return;
	}
}
