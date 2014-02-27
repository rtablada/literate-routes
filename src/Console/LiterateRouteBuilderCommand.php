<?php namespace Rtablada\LiterateRoutes\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Rtablada\LiterateRoutes\FileParser;

class LiterateRouteBuilderCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'literate:build';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Builds literate routes files.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(FileParser $fileParser)
	{
		$this->fileParser = $fileParser;

		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$path = $this->getPath();

		$this->fileParser->buildForDirectory($path);
	}

	/**
	 * Get the path where the command should be stored.
	 *
	 * @return string
	 */
	protected function getPath()
	{
		$path = $this->input->getArgument('path');

		if (is_null($path))
		{
			return $this->laravel['path'];
		}
		else
		{
			return $this->laravel['path.base'].'/'.$path;
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('path', InputArgument::OPTIONAL, 'The path where the command should be build literate routes.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
		);
	}

}
