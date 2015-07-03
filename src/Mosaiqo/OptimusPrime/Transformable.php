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

	protected $_defaultTransformer;

	/**
	 * Gets the transformer class name
	 *
	 * @return mixed
	 */
	public function getTransformer()
	{

		if (!property_exists($this , 'transformer') ||  !$this->transformer )
		{
			if(!$this->_defaultTransformer )
			{
				$this->createQualifiedTransformerClass();
			}
			return $this->_defaultTransformer;
		}

		return $this->transformer;
	}

	/**
	 * Sets the transformer class name
	 *
	 * @param $transformerClass
	 *
	 * @return $this
	 */
	public function setTransformer( $transformerClass )
	{
		$this->_defaultTransformer = $transformerClass;

		return $this;
	}


	/**
	 * @return mixed
	 */
	public function transform()
	{
		$transformer = $this->getTransformerClass();

		return $transformer->transform( $this );
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

	/**
	 * @return mixed
	 */
	public function getTransformerClass()
	{

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