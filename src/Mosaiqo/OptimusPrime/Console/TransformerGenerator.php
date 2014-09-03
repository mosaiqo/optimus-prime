<?php namespace Mosaiqo\OptimusPrime\Console;

use Illuminate\Filesystem\Filesystem;
use Mustache_Engine;

class TransformerGenerator
{
	/**
	 * @var Filesystem
	 */
	private $file;

	/**
	 * @var Mustache_Engine
	 */
	private $mustache;

	public function __construct(Filesystem $file, Mustache_Engine $mustache)
	{
		$this->file = $file;
		$this->mustache = $mustache;
	}

	public function make($input, $template, $destination)
	{
		$template = $this->file->get($template);

		$stub = $this->mustache->render($template, $input);

		$this->file->put($destination, $stub);
	}
}
