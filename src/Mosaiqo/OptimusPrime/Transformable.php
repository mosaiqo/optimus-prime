<?php namespace Mosaiqo\OptimusPrime;

use ReflectionClass;
use Symfony\Component\Process\Exception\InvalidArgumentException;

/**
 * Class Transformable
 *
 * @package Mosaiqo\OptimusPrime
 */
trait Transformable
{

	/**
	 * Gets the transformer class name
	 *
	 * @return mixed
	 */
	public function getTransformer()
	{
		return $this->transformer;
	}

	/**
	 * Sets the transformer class name
	 *
	 * @param $transformerClass
	 */
	public function setTransformer( $transformerClass )
	{
		$this->transformer = $transformerClass;
	}


	public function transform()
	{
		$transformer = $this->getTransformerClass();

		return $transformer->transform( $this->toArray() );
	}

	/**
	 * Creates the transformer class name in base
	 * of the current class name.
	 */
	private function createQualifiedTransformerClass()
	{
		$reflection                = new ReflectionClass( __CLASS__ );
		$name                      = $reflection->getName();
		$qualifiedTransformerClass = $name . "Transformer";

		$this->setTransformer( $qualifiedTransformerClass );
	}

	public function getTransformerClass()
	{
		if ( ! $this->getTransformer() )
		{
			$this->createQualifiedTransformerClass();
		}

		$className = $this->getTransformer();

		if ( ! class_exists( $className ) )
		{
			throw new InvalidArgumentException( "The class {$className} does not exist." );
		}

		app()->bind( 'transformer', $className );

		$transformer = app()->make( 'transformer' );

		if ( ! method_exists( $transformer, 'transform' ) )
		{
			throw new InvalidArgumentException( "The method 'transform' must exist in class {$className}." );
		}

		return $transformer;
	}
}