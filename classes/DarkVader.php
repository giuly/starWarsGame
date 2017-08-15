<?php
include_once('Character.php');
/**
* Dark Vader Class extends Character Class
*/

class DarkVader extends Character {

	function __construct($number, $lifeSpan) {

		$this->name = 'Dark Vader';
		$this->type = 'dv'; // dark vader
		$this->hitPoints = 9;

		// Exception for Dark Vader who's unique - add an empty space instead the number
		parent::setName('');

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