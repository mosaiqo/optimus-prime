<?php namespace spec\Mosaiqo\OptimusPrime\Stubs;

use Mosaiqo\OptimusPrime\Stubs\TransformableStubTransformer;
use Mosaiqo\OptimusPrime\Transformable;
use StubTrans;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Mosaiqo\OptimusPrime\Stubs\TransformableStub;

class TransformableStubSpec extends ObjectBehavior
{

	function it_is_initializable()
	{
		$this->shouldHaveType( 'Mosaiqo\OptimusPrime\Stubs\TransformableStub' );
	}

	function it_gets_the_transform_class_from_class_name()
	{
		$this->getTransformer()
			->shouldBe( 'Mosaiqo\OptimusPrime\Stubs\TransformableStubTransformer' );
	}

	function it_can_be_changed_with_custom_transformer_class_name()
	{
		$this->setTransformer('Mosaiqo\StubTrans');
		$this->getTransformer()->shouldBe('Mosaiqo\StubTrans');
	}

}
