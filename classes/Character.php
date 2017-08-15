<?php
/**
* Character class
*/

abstract class Character { 

	public $type;
	public $number;
	protected $name;
	protected $lifeSpan;
	protected $hitPoints;

	/**
	* When a character is hit, deduce $hitPoints from $lifeSpan
	*/
	abstract function hit();

	/*
	* Setter number property
	*/
	public function setNumber($number) {
		$this->number = $number;
	}

	/*
	* Setter name property
	*/
	public function setName($number) {
		$this->name .= $number;
	}

	/*
	* Setter name property
	*/
	public function setLifeSpan($lifeSpan) {
		$this->lifeSpan = $lifeSpan;
	}

}