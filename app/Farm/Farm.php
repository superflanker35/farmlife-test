<?php

namespace App\Farm;

class Farm
{
	private static $instance;
	private $barn;
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

			for($i = 0; $i<$value; $i++) {
				$animal = new $animalClass();
				$this->barn->addAnimal($animal);
			}
		}
	}

	/**
	 * @return mixed
	 */
	public function getBarn()
	{
		return $this->barn;
	}

	/**
	 * @return array
	 */
	public function getBarnAnimalsStats()
	{
		$barnAnimals = $this->barn->getAnimals();
		$result = [];

		foreach($barnAnimals as $value) {
			if(!array_key_exists($value->getType(),$result)){
				$result[$value->getType()] = 1;
			}else{
				$result[$value->getType()]++;
			}
		}

		return $result;
	}

}