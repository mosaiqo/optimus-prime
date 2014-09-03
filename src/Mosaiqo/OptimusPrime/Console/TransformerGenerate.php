<?php namespace Mosaiqo\OptimusPrime\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class TransformerGenerate extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'transformer:generate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generates a transformer with the given arguments.';
	/**
	 * @var TransformerGenerator
	 */
	private $generator;

	/**
	 * Create a new command instance.
	 *
	 * @param TransformerGenerator $generator
	 * @return \Mosaiqo\OptimusPrime\Console\TransformerGenerate
	 */
	public function __construct(TransformerGenerator $generator)
	{
		parent::__construct();
		$this->generator = $generator;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$path = $this->argument('path');
		$properties = $this->option('properties');
		$base = $this->option('base');

		$input = $this->parse($path, $properties);

		$this->generator->make($input, $this->getTemplate(), $this->getDestination($base, $path));

		$this->info($this->getThemeSong());
	}

	/**
	 * @param $base
	 * @param $path
	 * @return string
	 */
	public function getDestination($base, $path)
	{
		return "{$base}/{$path}.php";
	}

	/**
	 * @return string
	 */
	public function getTemplate()
	{
		return __DIR__ . '/stubs/transformer.stub';
	}

	/**
	 * @param $path
	 * @param $properties
	 * @return mixed
	 */
	public function parse($path, $properties)
	{
		$segments = explode('\\', str_replace('/', '\\',$path));
		$name = array_pop($segments);
		$namespace = implode('\\', $segments);

		$properties = preg_split('/ ?, ?/', $properties, null, PREG_SPLIT_NO_EMPTY);

		return compact('name','namespace','properties');
	}

	/**
	 * @return string
	 */
	public function getThemeSong()
	{
		return "The Transformers! More than meets the eye!\r\nAutobots wage their battle to destroy the evil forces of the Decepticons!\r\nThe Transformers! Robots in disguise!\r\nThe Transformers! More than meets the eye!\r\nThe Transformers!";
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('path', InputArgument::REQUIRED, 'The class path for the command to generate.'),
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
			array('properties', null, InputOption::VALUE_OPTIONAL, 'A comma-separated list of properties for the command.', "id"),
			array('base', null, InputOption::VALUE_OPTIONAL, 'The path to where your domain root is located.', "app"),
		);
	}

}
