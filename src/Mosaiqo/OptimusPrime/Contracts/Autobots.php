<?php namespace Mosaiqo\OptimusPrime\Contracts;

/**
 * Interface Autobots
 * @package Mosaiqo\OptimusPrime\Contracts
 */
interface Autobots {

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
	 * @param $item
	 * @return mixed
	 */
	public function transform($item);
}