<?php

namespace App\Farm;

class Farm
{
	private static $instance;
	private $barn;
	private $regNumbers = [];
	private $productCollectStats = [];
	private $weekDays = 7;
	private $initialAnimals = ['Cow'=>10,'Hen'=>20];

	private function __construct()
	{
		$this->init();
	}

	private function init()
	{
		$this->barn = new Barn();
		$this->addAnimalsToBarn($this->initialAnimals);
	}

	/**
	 * @return Farm
	 */
	public static function getInstance()
	{
		if(!isset(self::$instance)){
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @param $animalsArray
	 */
	public function addAnimalsToBarn($animalsArray)
	{
		foreach($animalsArray as $key=>$value) {
			switch($key){
				case "Hen":
					$animalClass = Hen::class;
					break;
				case "Cow":
					$animalClass = Cow::class;
					break;
				default:
					$animalClass = "";
					break;
			}

			//$str = "App\Farm\Hen";

			for($i = 0; $i<$value; $i++) {
				$animal = new $animalClass();
				$this->barn->addAnimal($animal);
				$this->regNumbers[] = $animal->getRegNumber();
			}
		}
	}

	/**
	 * @return array
	 */
	public function collectFromBarnAnimals()
	{
		$barnAnimals = $this->barn->getAnimals();
		$result = [];

		for($i=0; $i<$this->weekDays; $i++) {
			foreach ($barnAnimals as $value) {
				$type                       = $value->getType();
				$productTypeMeasurementUnit = $value->getProductType() . ' ' . $value->getProductUnitOfMeasurement();

				if (!array_key_exists($type, $result)) {
					$result[$type][$productTypeMeasurementUnit] = $value->collect();
				} else {
					$result[$type][$productTypeMeasurementUnit] += $value->collect();
				}
			}
		}

		$this->productCollectStats[] = $result;

		return $result;
	}

	/**
	 * @return array
	 */
	public function getBarnAnimalsStats()
	{
		$barnAnimals = $this->barn->getAnimals();
		$result = [];

		foreach($barnAnimals as $value) {
			$type = $value->getType();

			if(!array_key_exists($type,$result)){
				$result[$type] = 1;
			}else{
				$result[$type]++;
			}
		}

		return $result;
	}

	/**
	 * @return array
	 */
	public function getRegNumbers()
	{
		return $this->regNumbers;
	}

	/**
	 * @return array
	 */
	public function getProductCollectStats()
	{
		return $this->productCollectStats;
	}
}