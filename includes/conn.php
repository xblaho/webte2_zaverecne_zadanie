<?php

include 'config.php';


$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Connection refused to MySQL: ' . mysqli_connect_error());
}
else{
	$stmt = $con->prepare("SET NAMES UTF8MB4");
	$stmt->execute();
}

?>