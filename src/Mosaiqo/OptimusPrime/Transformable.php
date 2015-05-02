<?php namespace Mosaiqo\OptimusPrime;

use ReflectionClass;

/**
 * Class Transformable
 *
 * @package Mosaiqo\OptimusPrime
 */
trait Transformable
{
	/**
	 * The name of the class for the transformer
	 * who will handle the transformation.
	 *
	 * @var
	 */
	public $transformer;

	/**
	 * boots up the trait.
	 */
	public function bootTransformable()
	{
		if ( ! $this->getTransformer() )
		{
			$this->createQualifiedTransformerClass();
		}

	}

	/**
	 * Gets the transformer class name
	 * @return mixed
	 */
	public function getTransformer()
	{
		return $this->transformer;
	}

	/**
	 * Sets the transformer class name
	 * @param $transformerClass
	 */
	public function setTransformer( $transformerClass )
	{
		$this->transformer = $transformerClass;
	}

	/**
	 * Creates the transformer class name in base
	 * of the current class name.
	 */
	private function createQualifiedTransformerClass()
	{
		$reflection = new ReflectionClass( __CLASS__ );
		$name = $reflection->getName();
		$qualifiedTransformerClass = $name . "Transformer";

		$this->setTransformer( $qualifiedTransformerClass );
	}

}