<?php include("top.html"); 
      include("db_connection.php");

	  error_reporting(E_ALL);
	  ini_set('display_errors', 1);
?>

<?php

//Variables
// $singlesFile = file_get_contents("singles.txt");
// $singles = explode("\n", $singlesFile);
// $notInFile = false;
//Get User Information
$userName = $_GET["name"];

$sqlQuery = "SELECT * FROM singles where name = '" . $userName . "';";
$returned_singles = mysqli_query($conn, $sqlQuery);

while ($row = $returned_singles->fetch_assoc()) {
        $current_single_id = $row["id"];
        $current_single_gender = $row["gender"];
        $current_single_age = (int)$row["age"];
        
        $sqlQuery = "SELECT name FROM personality_type WHERE single_id = $current_single_id.";"";
  
        $returned_personality_type = mysqli_query($conn, $sqlQuery);

        $current_single_personality = $returned_personality_type->fetch_assoc()["name"];

        $sqlQuery = "SELECT name FROM fav_os WHERE single_id = $current_single_id . ";"";
        
        $returned_favorite_os = mysqli_query($conn, $sqlQuery);
        $current_single_os = $returned_favorite_os->fetch_assoc()["name"];


        /* get users min and max seek age */
        $sqlQuery = "SELECT min_age, max_age FROM seeking_age WHERE single_id = $current_single_id . ";"";
       
        $returned_seeking_age = mysqli_query($conn, $sqlQuery);
        $current_single_seeking_ages = $response_seek_ages->fetch_assoc();
        $current_single_min_age = (int)$current_single_seeking_ages["min_age"];
        $current_single_max_age = (int)$current_single_seeking_ages["max_age"];
    }

$potential_matches = array();


// foreach ($singles as $people) {
// 	$userInfo = explode(",", $people);
// 	if($userInfo[0] == $userName){   
// 		break;
// 	}
// }

//show all matches
function showMatches(){
	$matches = getMatches();
	for ($i=0; $i<sizeof($matches); $i++) {
		$rawMatch = explode(",", $matches[$i]);
		printMatches($rawMatch);
	}
}
//print matches
function printMatches($rawMatch){
	echo "<div class='match'>
		<p><img src='https://webster.cs.washington.edu/images/nerdluv/user.jpg' alt='user icon' />
		" . $rawMatch[0] . "</p>
		<ul>
			<li><strong>gender:</strong>" . $rawMatch[1] . "</li>
			<li><strong>age:</strong>" . $rawMatch[2] . "</li>
			<li><strong>type:</strong>" . $rawMatch[3] . "</li>
			<li><strong>OS:</strong>" . $rawMatch[4] . "</li>                        
		</ul>
		</div>";
}

//get match array
function getMatches(){
	global $singles;
	global $userInfo;
	$matches = $singles;
	$arraySize = sizeof($matches);
	
	//Test for gender compatibility
	for ($i=0; $i<$arraySize; $i++){
		$matchInfo = explode(",", $matches[$i]);
		$location = $i+1;
		if ($matchInfo[1] == $userInfo[1]){
			unset($matches[$i]); //remove same gender from array
		}
		else if ($matchInfo[4] != $userInfo[4]){
			unset($matches[$i]); //remove different OS from array
		}
		else if (($matchInfo[2] < $userInfo[5] || $matchInfo[2] > $userInfo[6]) || ($userInfo[2] < $matchInfo[5] || $userInfo[2] > $matchInfo[6])){
			unset($matches[$i]); //remove ages outside range from array
		}
		else if (!checkPersona(str_split($matchInfo[3]), str_split($userInfo[3])))
		{
			unset($matches[$i]); //remove incompatible personas from array
		}
	}
	$matches = array_values($matches); //re-indexes the array
	return $matches;
}

//check personality match
function checkPersona($matchPersona, $userPersona){
	for($i=0; $i<4; $i++){
		if ($matchPersona[$i] == $userPersona[$i]){
			return true;
		}
	}
}

?>

<h1>Matches for <?=$userName?></h1>

<?php showMatches();?>

<?php include("bottom.html"); ?>