<?php 
session_start();
include_once('./classes/Game.php');

// build characters features
$charctersNrs = array('dv'=> array('number' => 1, 'lifeSpan' => 100), 'st'=> array('number' => 5, 'lifeSpan' => 85), 'dt'=> array('number' => 8, 'lifeSpan' => 45));

function initTypes($charctersNrs) {
	$ret = array();
	foreach ($charctersNrs as $type => $values) {
		$ret[$type] = array();
		for($i=1; $i<=$values['number']; $i++) {
			$ret[$type][$i] = $values['lifeSpan'];
		}
	}
	return $ret;
}

// When the game is first loaded
// save all the lifeSpans into session variable
// to keep track whenever the HIT button is submited
if(!isset($_SESSION['lifeSpans']) || empty($_SESSION['lifeSpans'])) {
	$_SESSION['lifeSpans'] = initTypes($charctersNrs);
	$_SESSION['lastHit'] = '';
}

// Instantiate a new Game
$game = new Game($_SESSION['lifeSpans']);
$charactersObjs = $game->getCharacters();


if(isset($_POST['hit'])) {
	// when a specific character is hit
	if(isset($_POST['character']) && $_POST['character'] != '') {
		// pick up selected character
		$key = $_POST['character'];
	} else {
		// pick up a random character
		$key = array_rand($charactersObjs);
	}
	
	// hit the random character
	$charactersObjs[$key]->hit();
	// get the number of the hit character
	$number =  $charactersObjs[$key]->number;
	// get the type of the hit character
	$type = $charactersObjs[$key]->type;
	// update session variable - characters properties
	$_SESSION['lifeSpans'][$type][$number] = $charactersObjs[$key]->getLifespan();
	// last character hit
	$_SESSION['lastHit'] = $type.'_'.$number;
	// update characters array  
	$charactersObjs = $game->getCharacters();
} 

$rows = '';
$options = '';

// Game over - reset session and redirect to a new game
if(empty($charactersObjs)) {
	session_destroy();
	header("refresh: 1;");
}

// Iterate through characters object for building the view elements 
foreach ($charactersObjs as $key => $obj) {
	$lifeSpan = $obj->getLifespan();
	$active = ($lifeSpan <= 0) ? 'danger' : ( ($obj->type.'_'.$obj->number === $_SESSION['lastHit']) ? 'active' : '');
	$lifeSpan = ($lifeSpan <= 0) ? 'Out of hit points' : $lifeSpan;
 
	$rows .= '<tr class="'.$active.'">
		        <td class="col-md-5">'.$obj->getName().'</td>
		        <td class="col-md-2">'.$obj->type.'</td>
		        <td class="col-md-5">'.$lifeSpan.'</td>
		      </tr>';

	if((int)($lifeSpan)) {
		$options .= '<option value="'.$key.'">'.$obj->getName().'</option>';	      	
	}	      
	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h2>Star Wars Game</h2>
		<p>To play, there must be a button that enables a user to “hit” a random fighter. The selection of a fighter (trooper or vador) must be random. </p>            
		<table class="table">
		<thead>
		  <tr>
		    <th>Character</th>
		    <th>Type</th>
		    <th>LifeSpan</th>
		  </tr>
		</thead>
		<tbody>
		  <?php echo $rows; ?>
		</tbody>
		</table>
		<form method="POST" action="">
		  <div class="col-md-8"></div>
		  <div class="col-md-4">
		    <div class="col-md-6">
		    	<select class="form-control" name="character">
		          <option value="">Character</option>
		          <?php echo $options; ?>
		        </select>
		    </div>
		    <div class="col-md-4">
		        <?php 	
			      if($_SESSION['lifeSpans']['dv'][1] <= 0)  { 	
			      	echo '<input class="btn" type="submit" name="reset" value="RESET"/>	';
			      } else {
			      	echo '<input class="btn" type="submit" name="hit" value="HIT"/>';
			      } 
			    ?>
			</div>    	
		  </div>	
		</form>  
	</div>
</body>
</html>