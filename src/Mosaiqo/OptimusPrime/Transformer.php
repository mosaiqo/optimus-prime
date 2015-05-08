<?php namespace Mosaiqo\OptimusPrime;

use Exception;
use Mosaiqo\OptimusPrime\Contracts\Autobots;

/**
 * Class Transformer
 * @package Mosaiqo\OptimusPrime
 */
abstract class Transformer implements Autobots
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
	 * @param $item
	 * @throws Exception
	 * @return mixed
	 */
	public function transform($item)
	{
		throw new Exception("You have to implement your own transform method");
	}
}