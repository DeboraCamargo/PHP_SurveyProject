
<html>

<head>
    <title>Survey</title>

	<link href="./css/main.css" type="text/css" rel="stylesheet"/>

</head>

<body>
<?php

define("DBHOST", "localhost");
define("DBDB",   "lamp1_survey");
define("DBUSER", "lamp1_survey");
define("DBPW", "survey");

$db_conn = new mysqli(DBHOST, DBUSER, DBPW, DBDB);


if ($db_conn->connect_errno) {
    die ("Could not connect to database server".DBHOST."\n Error: ".$db_conn->connect_errno ."\n Report: ".$db_conn->connect_error."\n");
}

$success = false;



// Session starts here.
session_start();

if(isset($_SESSION["error"])){echo $_SESSION["error"]; }


$pageTo = "./Includes/start.php";
if(!isset($_SESSION["CurrentPage"])){$_SESSION["CurrentPage"] = "Start";}


if(isset($_POST['toPage1'])) {
	clearErrors();
   	$pageTo = "./Includes/page1.php";
	if($_SESSION["CurrentPage"] == "Page2"){	
		send_page2_fields_to_session();
	}
}


if(isset($_POST['toPage2'])) {
clearErrors();
	if($_SESSION["CurrentPage"] == "Page1"){	
		send_page1_fields_to_session();
		if(isPage1Valid()){
		   	$pageTo = "./Includes/page2.php";			
		}else{
			$pageTo = "./Includes/page1.php";		
		}
		
	}else{
		send_page3_fields_to_session();
		$pageTo = "./Includes/page2.php";			
	}
}


if(isset($_POST['toPage3'])) {
clearErrors();
	if($_SESSION["CurrentPage"] == "Page2"){
		send_page2_fields_to_session();

		if(isPage2Valid()){
		   	$pageTo = "./Includes/page3.php";			
		}else{
			$pageTo = "./Includes/page2.php";		
		}		
	}else{
		$pageTo = "./Includes/page3.php";			
	}	
}



if(isset($_POST['toSummary'])) {
clearErrors();
	send_page3_fields_to_session();

		if(isPage3Valid()){
		   	$pageTo =  "./Includes/summary.php";			
		}else{
			$pageTo = "./Includes/page3.php";		
		}		

}

if(isset($_POST['toStart'])) {
	$pageTo = "./Includes/start.php";
	send_page1_fields_to_session();
}



function isPage1Valid(){
	$valid = true;
	$_SESSION["fname_error_message"] = "";
	$_SESSION["age_error_message"] ="";
	$_SESSION["studentopt_error_message"] ="";


	if (!isset($_POST["age"]) or empty($_POST["fname"])) {
		$_SESSION["fname_error_message"] = "A name must be provided";
		$valid = false;
	}

	if (!isset($_POST["age"]) or !is_numeric($_POST["age"]) or $_POST["age"] <= 0) {
		$_SESSION["age_error_message"] = "Invalid Age";
		$valid = false;
	}

	if (!isset($_POST["studentopt"]) or $_POST["studentopt"] <= 0 ) {

		$_SESSION["studentopt_error_message"] = "Please select one option - Are you Student?";
		$valid = false;
	}


	return $valid;

}
function isPage2Valid(){

	$valid = true;
	$_SESSION["Check_error_message"] = "";
	$_SESSION["Radio_error_message"] ="";


	if (!isset($_SESSION["products"]) or count($_SESSION["products"]) == 0 ) {

		$_SESSION["Check_error_message"] = "Please select at least one product";
		$valid = false;
	}

	if (!isset($_POST["HowPurchase"]) or $_POST["HowPurchase"] < 0 ) {
		$_SESSION["Radio_error_message"] = "Please select one purchase method";
		$valid = false;
	}


	return $valid;

}
function isPage3Valid(){
	$valid = true;
	$product = $_SESSION["products"];
	$Happy = $_SESSION["happy"];
	$Recommed = $_SESSION["recommend"];

	for($x = 0; $x < count($product); $x++){
		if ($Happy[$product[$x]] <= 0) {
			
			$_SESSION[$product[$x]."_Satisfied_error_message"] = "Please, rate this product";

			$valid = false;
		}
		if ($Recommed[$product[$x]] <= 0) {
			$_SESSION[$product[$x]."_Recommend_error_message"] = "Please, select one";
			$valid = false;
		}
	}
	return $valid;
}

function clearErrors() {
	$_SESSION["fname_error_message"] = "";
	$_SESSION["age_error_message"] ="";
	$_SESSION["studentopt_error_message"] ="";
	$_SESSION["Check_error_message"] = "";
	$_SESSION["Radio_error_message"] ="";

	if(isset($_SESSION["products"])){
		$product = $_SESSION["products"];
		for($x = 0; $x < count($product); $x++){
			$_SESSION[$product[$x]."_Satisfied_error_message"] = "";
			$_SESSION[$product[$x]."_Recommend_error_message"] = "";
		}
	}
}



function send_page1_fields_to_session(){

		if(isset($_POST["fname"])){
			$_SESSION["fname"] = $_POST["fname"];

		}
		if(isset($_POST["age"])){
		 $_SESSION["age"] = $_POST["age"];
		}
		if(isset($_POST["studentopt"])){
		 $_SESSION["studentopt"] = $_POST["studentopt"];
		}	
}

function send_page2_fields_to_session(){

	$index = 0;
	$Happy = isset($_SESSION["happy"])? $_SESSION["happy"] : array();
	$Recommed = isset($_SESSION["recommend"])? $_SESSION["recommend"] :array();
        $product = array();

	if(isset($_POST["What_Purchase_HomePhone"])){
		$product[$index] = "Home_Phone";
		$Happy[$product[$index]] = empty($Happy[$product[$index]]) ? 0: $Happy[$product[$index]];
		$Recommed[$product[$index]] = empty($Recommed[$product[$index]]) ? 0: $Recommed[$product[$index]];
		$index++;
	}

	if(isset($_POST["What_Purchase_MobilePhone"])){
		$product[$index] = "Mobile_Phone";
		$Happy[$product[$index]] = empty($Happy[$product[$index]]) ? 0: $Happy[$product[$index]];
		$Recommed[$product[$index]] = empty($Recommed[$product[$index]]) ? 0: $Recommed[$product[$index]];
		$index++;
	}

	if(isset($_POST["What_Purchase_SmartTV"])){
		$product[$index] = "Smart_TV";
		$Happy[$product[$index]] = empty($Happy[$product[$index]]) ? 0: $Happy[$product[$index]];
		$Recommed[$product[$index]] = empty($Recommed[$product[$index]]) ? 0: $Recommed[$product[$index]];
		$index++;
	}
	if(isset($_POST["What_Purchase_Laptop"])){
		$product[$index] = "Laptop";
		$Happy[$product[$index]] = empty($Happy[$product[$index]]) ? 0: $Happy[$product[$index]];
		$Recommed[$product[$index]] = empty($Recommed[$product[$index]]) ? 0: $Recommed[$product[$index]];
		$index++;
	}
	if(isset($_POST["What_Purchase_DesktopComputer"])){
		$product[$index] = "Desktop_Computer";
		$Happy[$product[$index]] = empty($Happy[$product[$index]]) ? 0: $Happy[$product[$index]];
		$Recommed[$product[$index]] = empty($Recommed[$product[$index]]) ? 0: $Recommed[$product[$index]];
		$index++;
	}
	if(isset($_POST["What_Purchase_Tablet"])){
		$product[$index] = "Tablet";
		$Happy[$product[$index]] = empty($Happy[$product[$index]]) ? 0: $Happy[$product[$index]];
		$Recommed[$product[$index]] = empty($Recommed[$product[$index]]) ? 0: $Recommed[$product[$index]];
		$index++;
	}
	if(isset($_POST["What_Purchase_HomeTheater"])){
		$product[$index] = "Home_Theater";
		$Happy[$product[$index]] = empty($Happy[$product[$index]]) ? 0: $Happy[$product[$index]];
		$Recommed[$product[$index]] = empty($Recommed[$product[$index]]) ? 0: $Recommed[$product[$index]];
		$index++;
	}

	if(isset($_POST["HowPurchase"])){
	$_SESSION["HowPurchase"] = $_POST["HowPurchase"];
	}

	
	$_SESSION["products"] = $product;
	$_SESSION["recommend"] = $Recommed;
	$_SESSION["happy"] = $Happy;

}


function send_page3_fields_to_session(){

$product = array();
$Happy = array();
$Recommed = array();

	if(isset($_SESSION["products"])){
		$product = $_SESSION["products"];

		for($x = 0; $x < count($product); $x++){

			$Happy[$product[$x]] = isset($_POST["Happy_".$product[$x]])? $_POST["Happy_".$product[$x]]:0;
			$Recommed[$product[$x]] = isset($_POST["Recommend_".$product[$x]])? $_POST["Recommend_".$product[$x]]:0;

		}
		$_SESSION["recommend"] = $Recommed;
		$_SESSION["happy"] = $Happy;
	}

}



if (isset($_POST["SaveFormularie"])) {

	$success = save($db_conn);
	$_SESSION["CurrentPage"] = "Start";	
	
}


function save($db_conn){


	$product = array();
	if(isset($_SESSION["products"])){
		$product = $_SESSION["products"];

	}
	$Happy = array();
	if(isset($_SESSION["happy"])){
		$Happy = $_SESSION["happy"];

	}
	$Recommed = array();
	if(isset($_SESSION["recommend"])){
		$Recommed = $_SESSION["recommend"];

	}


	$last_id=-1;
	$qry = "insert into participants set part_fullname = '".$_SESSION["fname"]."', "
		."part_age  = ".$_SESSION["age"].","
		."part_student = '".$_SESSION["studentopt"]."'";
		$db_conn->query($qry);
		if($db_conn->errno != 0){
			echo $db_conn->error."<hr/>";
			return false;
		}else{

			$last_id = $db_conn->insert_id;

		}

	$text_recommend_format = "";
	for($x = 0; $x < count($product); $x++){
		$product[$x];

		switch ($Recommed[$product[$x]]){
		case 0: $text_recommend_format = "No selected";
			break;
		case 1: $text_recommend_format = "Yes";
			break;
		case 2:  $text_recommend_format = "Maybe";
			break;
		case 3:  $text_recommend_format = "No";
			break;
		default:
		} 

		$qry = "insert into responses set resp_part_id = ".$last_id.","
			."resp_product  = '".$product[$x]."',"
			."resp_how_purchased = '".$_SESSION["HowPurchase"]."',"
			."resp_satisfied  = ".$Happy[$product[$x]].","
			."resp_recommend = '".$text_recommend_format."'";

			unset($_SESSION["error"]);
			
			$db_conn->query($qry);
			if($db_conn->errno != 0){

				echo $db_conn->error."<hr/>";

				$_SESSION["error"] = $db_conn->error."<hr/>"; 
				return false;
			}
	}
	session_destroy();
	return true;
}


/*
resp_part_id       | int(11)      | NO   |     | NULL    |                |
| resp_product       | varchar(100) | NO   |     | NULL    |                |
| resp_how_purchased | varchar(50)  | NO   |     | NULL    |                |
| resp_satisfied     | int(11)      | NO   |     | NULL    |                |
| resp_recommend     | varchar(10)  | NO   |     | NULL    |         
*/




require_once($pageTo);


?>


</body>
</html>
