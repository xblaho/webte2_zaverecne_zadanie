<?php
include_once("includes/conn.php");

if(!isset($_POST["name"])){
	die("Cant log - not all fields set");
}

if(empty($_POST["name"])){
	die("Cant log - some input fields are empty");
}
//IF EXISTS
if($stmt = $con->prepare('INSERT INTO individual_tasks_use_log(nazov) VALUES(?)')){
	$stmt->bind_param("s",$_POST["name"]);
	if($stmt->execute()){
	}
	else{
		echo "Something went wrong with execute.";
	}
}
else{
	echo "Something went wrong with prepare.";
}



?>