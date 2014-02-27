<?php namespace Rtablada\LiterateRoutes;

use Illuminate\Support\Str;

class Parser
{
	protected $controller;

	protected $asNamespace;

	public function compileString($string, $newFile = true)
	{
		$this->resetVars();
		$parts = preg_split('/[\n\r]{2}/', $string);
		$return = '';

		foreach ($parts as $part) {
			$return .= $this->compileVars($part);
			$return .= $this->compileComment($part);
			$return .= $this->compileCodeBlock($part);
		}
		$return = $newFile ? "<?php\n\n" . $return : $return;

		return $return;
	}

	public function compileVars($string)
	{
		if (preg_match('/^@setController\(\'(.*)\',\s*\'(.*)\'\)/', $string, $matches)) {
			$this->controller = $matches[1];
			$this->asNamespace = $matches[2];
		} elseif (preg_match('/^@setController\(\'(.*)\'\)/', $string, $matches)) {
			$this->controller = $matches[1];
		}
	}

	public function compileComment($string)
	{
		$matches = array();

		if (preg_match('/#(.*)/', $string, $matches)) {
			if (!$this->controller) {
				$this->controller = Str::studly($matches[1]);
			}
			return "//{$matches[1]}\n\n";
		}
	}

	public function compileCodeBlock($string)
	{
		$return = null;
		if (preg_match('/^[(\s\s)\t]+@/', $string)) {
			$return .= $this->compileShortRoutes($string);
			$return .= $this->compileRoutes($string);
		}

		return $return;
	}

	public function compileShortRoutes($string)
	{
		preg_match_all('/\n?[(\s\s)\t]+(.*)-> \'(.*)\', \'(.*)\'(;)?/', $string, $matches, PREG_SET_ORDER);
		$return = null;

		foreach ($matches as $match) {
			$method = $match[1];
			$uri = $match[2];
			$uses = "{$this->controller}@{$match[3]}";
			$as = "{$this->asNamespace}.{$match[3]}";

			$return .= "Route::{$method}('{$uri}', array('uses' => {$uses}, 'as' => '{$as}'));\n";
		}

		return $return;
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

	protected function resetVars()
	{
		$this->controller = null;
		$this->asNamespace = null;
	}
}
