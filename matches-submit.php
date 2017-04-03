<?php include("top.html"); 
      include("db_connection.php");

	  error_reporting(E_ALL);
	  ini_set('display_errors', 1);
?>

<?php

//Get User Information
$userName = $_GET["name"];

$sqlQuery = "SELECT * FROM singles where name = '" . $userName . "';";
$returned_singles = mysqli_query($conn, $sqlQuery);
// echo $returned_singles;

while ($row = $returned_singles->fetch_assoc()) {
        $current_single_id = $row["id"];
        $current_single_gender = $row["gender"];
        $current_single_age = (int)$row["age"];
        
        $sqlQuery = "SELECT type FROM personality_types WHERE single_id = $current_single_id.";"";
  
        $returned_personality_type = mysqli_query($conn, $sqlQuery);

        $current_single_personality = $returned_personality_type->fetch_assoc()["type"];

        $sqlQuery = "SELECT os FROM favorite_os WHERE single_id = $current_single_id.";"";
        
        $returned_favorite_os = mysqli_query($conn, $sqlQuery);
        $current_single_os = $returned_favorite_os->fetch_assoc()["os"];


        /* get users min and max seek age */
        $sqlQuery = "SELECT min_age, max_age FROM seeking_age WHERE single_id = $current_single_id.";"";
       
        $returned_seeking_age = mysqli_query($conn, $sqlQuery);
        $current_single_seeking_ages = $returned_seeking_age->fetch_assoc();
        echo $current_single_seeking_ages;
        $current_single_min_age = (int)$current_single_seeking_ages["min_age"];
        $current_single_max_age = (int)$current_single_seeking_ages["max_age"];
    }

//show all matches
function showMatches($conn, $current_single_id, $current_single_gender, $current_single_age, $current_single_personality, $current_single_os, $current_single_min_age, $current_single_max_age ){
	$matchResults = getMatchResults($conn, $current_single_id, $current_single_gender, $current_single_age, $current_single_personality, $current_single_os, $current_single_min_age, $current_single_max_age);
	while ($row = $matchResults->fetch_assoc()) {
        /* At least one personality type in common */
        $inRegex = "/[".$user_personality."]/";
        if (preg_match($inRegex, $row["personality_types"]) === 1){
            $matches[] = $row;
            if ($is_first) {
?>
        <strong>Matches for <?= $_GET["name"] ?></strong><br>
<?php
                $is_first = false;
            }
?>
  <div class="match">
      <img src="user.jpg" alt="photo"/>
      <div>
          <ul>
              <li><p><?= $row["name"] ?></p></li>
              <li><strong>gender:</strong> <?= $row["gender"] ?></li>
              <li><strong> age:</strong> <?= $row["age"] ?> </li>
              <li><strong> type:</strong> <?= $row["personality_types"] ?> </li>
              <li><strong> OS:</strong> <?= $row["favorite_os"] ?></li>
          </ul>
      </div>
  </div>
<?php  
		}
	}
}
//print matches
// function printMatches($rawMatch){
// 	echo "<div class='match'>
// 		<p><img src='https://webster.cs.washington.edu/images/nerdluv/user.jpg' alt='user icon' />
// 		" . $rawMatch[0] . "</p>
// 		<ul>
// 			<li><strong>gender:</strong>" . $rawMatch[1] . "</li>
// 			<li><strong>age:</strong>" . $rawMatch[2] . "</li>
// 			<li><strong>type:</strong>" . $rawMatch[3] . "</li>
// 			<li><strong>OS:</strong>" . $rawMatch[4] . "</li>                        
// 		</ul>
// 		</div>";
// }

//get match array
function getMatchResults($conn, $current_single_id, $current_single_gender, $current_single_age, $current_single_personality, $current_single_os, $current_single_min_age, $current_single_max_age){
	$potential_matches = array();

	$gender = '';
	if ($current_single_gender =='M') {
    $gender = 'F';
	} else {
    $gender = 'M';
	}

	$sqlQuery = "SELECT singles.name, singles.gender, singles.age, personality_types.type as personality_types, favorite_os.os as favorite_os FROM singles JOIN personality_types ON singles.id = personality_types.single_id JOIN seeking_age on singles.id = seeking_age.single_id JOIN favorite_os ON singles.id = favorite_os.single_id WHERE singles.gender = '$gender' and singles.age >= $current_single_min_age and singles.age <= $current_single_max_age and seeking_age.min_age <= $current_single_age and seeking_age.max_age >= $current_single_age and favorite_os.os = '$current_single_os'; ";
	echo $sqlQuery;

	$results = mysqli_query($conn, $sqlQuery);

	return $results;
}

?>

<!-- h1>Matches for <?=$userName?></h1> -->

<?php showMatches($conn, $current_single_id, $current_single_gender, $current_single_age, $current_single_personality, $current_single_os, $current_single_min_age, $current_single_max_age);?>

<?php include("bottom.html"); ?>