<?php
include_once('Character.php');
/**
* Storm Trooper Class extends Character Class
*/

class StormTrooper extends Character {
	
	function __construct($number, $lifeSpan) {

		$this->name = 'Storm Trooper';
		$this->type = 'st'; // storm trooper
		$this->hitPoints = 10;

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