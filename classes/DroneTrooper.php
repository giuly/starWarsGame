<?php
include_once('Character.php');
/**
* Drone Trooper Class extends Character Class
*/

class DroneTrooper extends Character {
	
	function __construct($number, $lifeSpan) {

		$this->name = 'Drone Trooper';
		$this->type = 'dt'; // dron trooper
		$this->hitPoints = 14;

		parent::setName($number);
		parent::setNumber($number);
		parent::setLifeSpan($lifeSpan);
	}

	/**
	* When a character is hit, deduce $hitPoints from $lifeSpan
	*/
	public function hit() {
		$this->lifeSpan -= $this->hitPoints;
	}

	/**
	* Getter function to return the name of the character
	*/
	public function getName() {
		return $this->name;
	}

	/**
	* Get remained lifespan
	*/
	public function getLifespan() {
		return $this->lifeSpan;
	}

}