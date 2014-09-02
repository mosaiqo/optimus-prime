<?php namespace Mosaiqo\OptimusPrime\Contracts;

/**
 * Interface Transformer
 * @package Mosaiqo\OptimusPrime\Contracts
 */
interface Transformer {

	/**
	 * Iterates whether a collection or an
	 * array to the transform method.
	 *
	 * @param array|collection $collection
	 * @return array
	 */
	public function transformCollection($collection);

	/**
	 * Abstract method to transform each item in the collection,
	 * you need to implement this in your inherited class.
	 *
	 * @param array $item
	 * @return mixed
	 */
	public function transform(array $item);
}