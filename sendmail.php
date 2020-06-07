<?php
include 'includes/conn.php';

if(!isset($_POST["mailTo"])){
	echo "No email given.";
}
else{
	if(empty($_POST["mailTo"])){
		echo "No email given.";
	}
	else{

		$message = '<table><thead><tr><th>Individuálna úloha</th><th>Používaná (kus)</th></tr></thead><tbody>';
		$query = "SELECT nazov, COUNT(*) FROM individual_tasks_use_log GROUP BY nazov";
		if($stmt = $con->prepare($query)){
			if($stmt->execute()){
				$stmt->bind_result($nazov, $count);
				$stmt->store_result();
				if($stmt->num_rows > 0){
					while ($stmt->fetch()) {
						$message.= '<tr>';
						$message.= '<td>'.$nazov.'</td>';
						$message.= '<td>'.$count.'</td>';
						$message.= '</tr>';
					}
				}
			}
		}
		$message.= '</tbody></table>';
		$to      = $_POST["mailTo"];
		$subject = 'Webte 2 finálne zadanie štatistika ';
		$headers = 'From: webte2@webte2.com' . "\r\n" .
	    'Reply-To: webte2@webte2.com' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	    $success = mail($to, $subject, $message, $headers);;
		if (!$success) {
			echo "error";
   			print_r(error_get_last());
		}
		else{
			header("Location: statistics.php");
		}
	}
}

?>