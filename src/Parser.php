<?php namespace Rtablada\LiterateRoutes;

class Parser
{
	public function compileComment($string)
	{
		$matches = array();

		if (preg_match('/#(.*)/', $string, $matches)) {
			return "//{$matches[1]}\n\n";
		}
	}

	public function compileRoutes($string)
	{
		if (preg_match('/^[(\s\s)\t]+@/', $string)) {
			$lines = explode("\n", $string);

			foreach ($lines as $line) {
				if (preg_match('/[(\s\s)\t]+@(.*)(;)?/', $string, $matches)) {
					return "Route::{$matches[1]};\n";
				}
			}
		}
	}
}
