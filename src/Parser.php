<?php namespace Rtablada\LiterateRoutes;

class Parser
{
	public function compileComment($string)
	{
		$matches = array();

		if (preg_match('/#(.*)/', $string, $matches)) {
			return "//{$matches[1]}";
		}
	}
}
