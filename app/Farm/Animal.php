<?php

namespace App\Farm;

abstract class Animal
{
	private int $minCollected;
	private int $maxCollected;
	private int $regNumber;

	private $type;
	private string $productType;
	private string $productUnitOfMeasurement;

	/**
	 * Animal constructor.
	 *
	 * @param string $type
	 * @param string $productType
	 * @param string $productUnitOfMeasurement
	 */
	public function __construct(string $type='',string $productType='',string $productUnitOfMeasurement='')
	{
		$this->init($type,$productType,$productUnitOfMeasurement);
	}

	/**
	 *
	 */
	private function init($type,$productType,$productUnitOfMeasurement)
	{
		$this->setRegNumber();
		$this->setType($type);
		$this->setProductType($productType);
		$this->setProductUnitOfMeasurement($productUnitOfMeasurement);
	}

	/**
	 *
	 */
	private function setRegNumber()
	{
		$this->regNumber = rand(10000,99999);
	}

	/**
	 * @return integer
	 */
	public function getRegNumber()
	{
		return $this->regNumber;
	}

	/**
	 *
	 */
	private function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 *
	 */
	private function setProductUnitOfMeasurement($productUnitOfMeasurement)
	{
		$this->productUnitOfMeasurement = $productUnitOfMeasurement;
	}

	/**
	 * @return string
	 */
	public function getProductUnitOfMeasurement()
	{
		return $this->productUnitOfMeasurement;
	}

	/**
	 *
	 */
	private function setProductType($productType)
	{
		$this->productType = $productType;
	}

	/**
	 * @return string
	 */
	public function getProductType()
	{
		return $this->productType;
	}


	/**
	 * @param $minCollected
	 */
	public function setMinCollected($minCollected)
	{
		$this->minCollected = $minCollected;
	}

	/**
	 * @param $maxCollected
	 */
	public function setMaxCollected($maxCollected)
	{
		$this->maxCollected = $maxCollected;
	}

	/**
	 * @return integer
	 */
	public function collect() : int
	{
		return rand($this->minCollected,$this->maxCollected);
	}

}