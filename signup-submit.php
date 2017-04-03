<?php include("top.html");
	  include("db_connection.php");

	  error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!-- Take form input from signup.php and write it to the singles.txt file -->
<?php

$personas = array("ESTJ", "ISTJ", "ENTJ", "INTJ",
    "ESTP", "ISTP", "ENTP", "INTP",
    "ESFJ", "ISFJ", "ENFJ", "INFJ",
    "ESFP", "ISFP", "ENFP", "INFP"
);

// Validate that no fields are empty
foreach ($_POST as $key => $value) {

 if(!isset($value) || empty($value)) {
      printError($key." must not be blank.");
   }
}

if (!in_array($_POST["persona"], $personas)) {
      printError("Invalid persona!");
}

if (!is_numeric($_POST["age"]) || strlen($_POST["age"]) > 2) {
    printError("Age must be a number and only two characters long");
}

if (!is_numeric($_POST["minage"]) || !is_numeric($_POST["maxage"])) {
    printError("Min/Max seeking age is not a number.");
}


function printError($errorString){
	echo "<div class='errors'>
		<pre>Error: ".$errorString."</pre>
		</div>";
		include("bottom.html");
		exit(0);
}

//make sure the first letter in each word in the name string capitalized
$userName = ucwords($_POST["name"]);
$gender = $_POST['gender'];
$age = $_POST['age'];
$os = $_POST['OS'];
$persona = $_POST['persona'];
$minage = $_POST['minage'];
$maxage = $_POST['maxage'];

// echo $_POST;

// global $conn;

$insertionSQL = "INSERT INTO singles (name, gender, age) VALUES ('$userName', '$gender', '$age')";

echo $insertionSQL;

mysqli_query($conn,$insertionSQL);

$single_id = mysqli_insert_id($conn);

$insertionSQL = "INSERT INTO favorite_os (single_id, os) VALUES ('$single_id','$os')";

mysqli_query($conn,$insertionSQL);

$insertionSQL = "INSERT INTO personality_types (single_id, type) VALUES ('$single_id','$persona')";

mysqli_query($conn,$insertionSQL);

$insertionSQL = "INSERT INTO seeking_age (single_id, min_age, max_age) VALUES ('$single_id','$minage','$maxage')";

mysqli_query($conn,$insertionSQL);


?>

<pre>
    Thank you!
    Welcome to NerdLuv, <?= $_POST["name"] ?>!
    Now <a href="matches.php">log in to see your matches!</a>
</pre>

<?php include("bottom.html"); ?>