<?php namespace Mosaiqo\OptimusPrime;

use Exception;

/**
 * Class Transformer
 * @package Mosaiqo\OptimusPrime
 */
abstract class Transformer
{

	/**
	 * Iterates whether a collection or an
	 * array to the transform method.
	 *
	 * @param array|collection $collection
	 * @return array
	 */
	public function transformCollection($collection)
	{
		if(is_object($collection))
			$collection = $collection->toArray()["data"];

		return array_map([$this , "transform"], $collection);
	}

	/**
	 * Abstract method to transform each item in the collection,
	 * you need to implement this in your inherited class.
	 *
	 * @param array $item
	 * @throws Exception
	 * @return mixed
	 */
	public function transform(array $item)
	{
		throw new Exception("You have to implement your own transform method");
	}
}