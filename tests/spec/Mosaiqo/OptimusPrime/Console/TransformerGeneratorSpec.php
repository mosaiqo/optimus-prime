<?php

namespace spec\Mosaiqo\OptimusPrime\Console;

use Illuminate\Filesystem\Filesystem;
use Mustache_Engine;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TransformerGeneratorSpec extends ObjectBehavior
{
	function let(Filesystem $filesystem, Mustache_Engine $mustacheEngine)
	{
		$this->beConstructedWith($filesystem, $mustacheEngine);
	}

	function it_is_initializable()
	{
		$this->shouldHaveType('Mosaiqo\OptimusPrime\Console\TransformerGenerator');
	}

	function it_generates_a_transformer_class(Filesystem $filesystem, Mustache_Engine $mustacheEngine)
	{
		$input = 'Acme\Bar\SomeTransformer';
		$template = 'transformer.stub';
		$destination = 'app/Acme/Bar/SomeTransformer.php';

		$filesystem->get($template)->shouldBeCalled()->willReturn('template');
		$mustacheEngine->render('template', $input)->shouldBeCalled()->willReturn('stub');
		$filesystem->put($destination, 'stub')->shouldBeCalled();

		$this->make($input, $template, $destination);
	}

}
