<?php namespace spec\Mosaiqo\OptimusPrime;

use StubTrans;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TransformableStubSpec extends ObjectBehavior
{

	function it_is_initializable()
	{
		$this->shouldHaveType( 'Mosaiqo\OptimusPrime\TransformableStub' );
	}

	function it_gets_the_transform_class_from_class_name()
	{
		$this->bootTransformable();
		$this->getTransformer()
			->shouldBe( 'Mosaiqo\OptimusPrime\TransformableStubTransformer' );
	}

	function it_can_be_changed_with_custom_transformer_class_name()
	{
		$this->transformer = 'Mosaiqo\StubTrans';

		$this->bootTransformable();
		$this->transformer->shouldBe('Mosaiqo\StubTrans');
	}
}
