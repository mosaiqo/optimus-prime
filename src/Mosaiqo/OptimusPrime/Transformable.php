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


	public function transform()
	{
		$className = $this->getTransformer();
		if(!class_exists($className))
		{
			throw new InvalidArgumentException('The class {$className} does not exist.');
		}

		app()->bind('transformer', $className);
		$transformer = app()->make('transformer');
		if(!method_exists($transformer, 'transform'))
		{
			throw new InvalidArgumentException( 'The method "transform" musst exist in class {$className}.' );
		}

		return $transformer->transform($this);

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