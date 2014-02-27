<?php namespace Rtablada\LiterateRoute\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Rtablada\LiterateRoute\FileParser;

class literateRoute extends Command {

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
		//
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('example', InputArgument::VALUE_OPTIONAL, 'An example argument.'),
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
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
