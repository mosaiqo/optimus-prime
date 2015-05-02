<?php namespace Mosaiqo\OptimusPrime;

interface Decepticons
{
	/**
	 * boots up the trait.
	 */
	public function bootTransformable();

	/**
	 * Gets the transformer class name
	 *
	 * @return mixed
	 */
	public function getTransformer();

	/**
	 * Sets the transformer class name
	 *
	 * @param $transformerClass
	 */
	public function setTransformer( $transformerClass );

}