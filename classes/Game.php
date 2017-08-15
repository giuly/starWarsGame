<?php

include_once('DarkVader.php');
include_once('StormTrooper.php');
include_once('DroneTrooper.php');
/**
* Game class
*/

class Game {
	
	private $status = FALSE;
	private $characters = array();
	private $lifeSpans = array();

	
	function __construct($lifeSpans) {
		$this->lifeSpans = $lifeSpans;
		// initialize all the characters 
		$this->initCharaters();
	}

	/**
	* Initialize characters
	*/
	private function initCharaters() {
		// start game
		$this->status = TRUE;
		// get Dark Vader remained 'hit points' number
		$dvLifeSpan = $this->lifeSpans['dv'][1];
		// check if there is more than one Dark Vader or he ran out of hit points
		if( count($this->lifeSpans['dv']) != 1 || $dvLifeSpan <= 0 ) {
			$this->resetCharatcters();
			return;
		}

		foreach ($this->lifeSpans as $type => $values) {
			for($i=1; $i<=count($values); $i++) {
				$this->newCharacter($type, $i, $values[$i]);
			}
		}
	}

	/**
	* Instantiate new character
	*/
	private function newCharacter($type, $number, $lifeSpan) {
		switch ($type) { 
			case 'dv':
				$character = new DarkVader($number, $lifeSpan);
				break;
			case 'st':
				$character = new StormTrooper($number, $lifeSpan);
				break;
			case 'dt':
				$character = new DroneTrooper($number, $lifeSpan);
				break;
			default:
				exit('Character type unavailable');
				break;
		}

		// check if the character has 'hit points' remained
		if($character->getLifespan() > 0){
			array_push($this->characters, $character);
		}
	}

	/**
	* Reset characters array to empty array
	*/
	public function resetCharatcters() {
		$this->characters = array();
		$this->status = FALSE;
	}
 
	/**
	* Returns all characters instances (Getter)
	*/
	public function getCharacters() {
		return $this->characters;
	}

	/**
	* Status Getter
	*/
	public function getStatus() {
		return $this->status;
	}

	/*
	* Debug function - echo $data variable wrapped in <pre> tag
	* @param - data (int, string, array, obj, etc.)
	* @return void 
	*/
	function x($data) {
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
 
}