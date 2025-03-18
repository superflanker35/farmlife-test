<?php

namespace App\Farm;

class Farm
{
	private static $instance;
	private $barn;

	private function __construct()
	{
		$this->init();
	}

	private function init()
	{
		$this->barn = new Barn();
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

	public function getBarn()
	{
		return $this->barn;
	}

}