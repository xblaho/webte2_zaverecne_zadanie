<?php

header("Content-Type:application/json");
include 'includes/conn.php';

$api_key = "ABC";
$resultArray = array(); // POZASTAVA Z DATA + ERROR + FINAL array 
$dataArray = array();     // HODNOTY PRE ANIMÁCIU A PRE GRAF
$errorArray = array(); // ERRORY 
$finalArray = array();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     if(isset($_GET["type"]) && isset($_GET["apikey"])){
     	if(!empty($_GET["type"]) && !empty($_GET["apikey"])){
     		if($_GET["apikey"] == $api_key){

     			// KYVADLO START
     			if($_GET["type"] == "kyvadlo"){

     			    if(isset($_GET["input"]) && isset($_GET["initPozicia"]) && isset($_GET["initUhol"])){
     			        $r = $_GET["input"];
     			        $initPozicia = $_GET["initPozicia"];
     			        $initUhol = $_GET["initUhol"];

     			        $octaveOutput = shell_exec("octave --no-gui --quiet octave_scripts/kyvadlo.txt $r $initPozicia $initUhol");
                        $octaveOutput = preg_replace('!\s+!', ' ', $octaveOutput); //remove line breaks (turn into one line)

                        $outPut2Parts = explode("=END=", $octaveOutput); //array
                        $valuePairsArray = explode(" ", trim($outPut2Parts[0]));
                        $finalValuesArray = explode(" ", trim($outPut2Parts[1]));

                        $dataArray = array();
                        while(sizeof($valuePairsArray) > 0){
                            $data = ["pendulum_position" => $valuePairsArray[0], "pendulum_angle" => $valuePairsArray[1]];
                            array_push($dataArray, $data);

                            array_shift($valuePairsArray); //shift twice to remove first 2 elements
                            array_shift($valuePairsArray);
                        }

                        $finalPosition = $finalValuesArray[0];
                        $finalAngle = $finalValuesArray[2];
                        $finalArray = ["finalPosition" => $finalPosition, "finalAngle" => $finalAngle];

                        //LOG REQUEST START

                        if($stmt = $con->prepare('INSERT INTO caslogs(commands_sent,error_flag,error_description) VALUES(?,?,?)')){
                            $commandsSent = "octave --no-gui --quiet octave_scripts/tlmenie.txt $r $initPozicia $initUhol";
                            $errorFlag = 0;
                            $errorDesc = "";
                            $stmt->bind_param("sis",$commandsSent, $errorFlag, $errorDesc);
                            if($stmt->execute()){
                            }
                            else{
                                array_push($errorArray, ["error" => "database error: cant log request (execute error - vlastny prikaz - $stmt->error)"]);
                            }
                        }
                        else{
                            array_push($errorArray, ["error" => "database error: cant log request (prepare error - vlastny prikaz - $stmt->error)"]);
                        }

                        //LOG REQUEST STOP
                    }
                    else{
                        array_push($errorArray, ["error" => "Error: undefined input variable. Set all initial variables."]);
                    }
//     				array_push($resultArray, ["kyvadlo" => "kyvadlo"]);
     			}
     			// KYVADLO STOP

     			// GULICKA START
     			else if($_GET["type"] == "gulicka"){
     				array_push($resultArray, ["gulicka" => "gulicka"]);
     			}
     			//GULICKA STOP

     			// TLMENIE START
     			else if($_GET["type"] == "tlmenie"){
     				if(isset($_GET["input"]) && isset($_GET["initX1"]) && isset($_GET["initX1d"]) && isset($_GET["initX2"]) && isset($_GET["initX2d"])){
     					$r = $_GET["input"];
     					$initX1 = $_GET["initX1"];
     					$initX1d = $_GET["initX1d"];
     					$initX2 = $_GET["initX2"];
     					$initX2d = $_GET["initX2d"];
     					$output = shell_exec("octave --no-gui --quiet octave_scripts/tlmenie.txt $r $initX1 $initX1d $initX2 $initX2d");
     					$output = preg_replace('!\s+!', ' ', $output);
     					$splitted = explode("*END*", $output);
     					$splittedFirst = explode(" ", $splitted[0]);
     					array_shift($splittedFirst);
                        array_pop($splittedFirst);
                        $splittedLast = explode(" ", $splitted[1]);
                        array_shift($splittedLast);
                        array_pop($splittedLast);
                        for($i =0; $i<count($splittedFirst); $i=$i+2){
                            $data = array();
                            array_push($data, ["pozicia_vozidla" => $splittedFirst[$i]]);
                            array_push($data, ["pozicia_kolesa" => $splittedFirst[$i+1]]);
                            array_push($dataArray, $data);
                        }

                        array_push($finalArray, ["initX1" => number_format(round(floatvaL($splittedLast[1]),6),5,'.',',')]);
						array_push($finalArray, ["initX1d" => number_format(round(floatvaL($splittedLast[3]),6),5,'.',',')]);
						array_push($finalArray, ["initX2" => number_format(round(floatvaL($splittedLast[5]),6),5,'.',',')]);
						array_push($finalArray, ["initX2d" => number_format(round(floatvaL($splittedLast[7]),6),5,'.',',')]);

						 //LOG REQUEST START 

	     				if($stmt = $con->prepare('INSERT INTO caslogs(commands_sent,error_flag,error_description) VALUES(?,?,?)')){
	     					$commandsSent = "octave --no-gui --quiet octave_scripts/tlmenie.txt $r $initX1 $initX1d $initX2 $initX2d";
	     					$errorFlag = 0;
	     					$errorDesc = "";
		     				$stmt->bind_param("sis",$commandsSent, $errorFlag, $errorDesc);
		     				if($stmt->execute()){
							}
		     				else{
		     					array_push($errorArray, ["error" => "cant log request (execute error - vlastny prikaz - $stmt->error)"]);
	     					}
	     				}
	     				else{
	     					array_push($errorArray, ["error" => "cant log request (prepare error - vlastny prikaz - $stmt->error)"]);
	     				}

	     								//LOG REQUEST STOP
     				}
     				else{
     					array_push($errorArray, ["error" => "not all inputs set (tlmenie)"]);
     				}
     			}
     			// TLMENIE STOP

     			// LIETADLO START
     			else if($_GET["type"] == "lietadlo"){
     				if(isset($_GET["input"]) && isset($_GET["initAlpha"]) && isset($_GET["initQ"]) && isset($_GET["initTheta"])){
     					if(1){

                                   $r = $_GET["input"];
                                   $initAlpha = $_GET["initAlpha"];
                                   $toTargetNaklonRemained = $_GET["input"];
                                   $initQ = $_GET["initQ"];
                                   $initTheta = $_GET["initTheta"];
                                   if(floatval($_GET["input"]) >= 0 && floatval($initAlpha) >= 0 && floatval($initQ) >= 0 && floatval($initTheta) >= 0){
                                        $output = shell_exec("octave --no-gui --quiet octave_scripts/airplane.txt $r $initAlpha $initQ $initTheta");
                                       echo "<pre>";
                                       var_export($output);
                                       echo "</pre>";

                                        $output = preg_replace('!\s+!', ' ', $output);

                                        $errorFlag = 0; //LOG 
	     								$errorDesc = ""; //LOG

                                        $frontAndEndValues = explode("====KONIEC====", $output);

                                        $frontValues = explode(" ", $frontAndEndValues[0]);
                                        array_shift($frontValues);
                                        array_pop($frontValues);

                                        $endValues = explode(" ", $frontAndEndValues[1]);
                                        array_shift($endValues);
                                        array_pop($endValues);

                                        for($i =0; $i<count($frontValues); $i=$i+2){

                                             $newFrame = array();
                                             array_push($newFrame, ["naklon_lietadla" => $frontValues[$i]]);
                                             array_push($newFrame, ["naklon_zadnej_klapky" => $frontValues[$i+1]]);
                                             array_push($dataArray, $newFrame);
                                        }

                                        if(count($endValues) === 6){

                                             array_push($finalArray, ["initAlpha" => $endValues[1]]);

                                             array_push($finalArray, ["initQ" => $endValues[3]]);

                                             array_push($finalArray, ["initTheta" => $endValues[5]]);

                                        }
                                        else{
                                             array_push($errorArray, ["error" => "unexpected result from Octave"]);
                                             $errorFlag = 1;
                                             $errorDesc = "Unexpected result from octave";
                                        }

                                        //LOG REQUEST START 

	     								if($stmt = $con->prepare('INSERT INTO caslogs(commands_sent,error_flag,error_description) VALUES(?,?,?)')){
	     									$commandsSent = "octave --no-gui --quiet octave_scripts/airplane.txt $r $initAlpha $initQ $initTheta";
		     								$stmt->bind_param("sis",$commandsSent, $errorFlag, $errorDesc);
		     								if($stmt->execute()){
											}
		     								else{
		     									array_push($errorArray, ["error" => "cant log request (execute error - vlastny prikaz - $stmt->error)"]);
	     									}
	     								}
	     								else{
	     									array_push($errorArray, ["error" => "cant log request (prepare error - vlastny prikaz - $stmt->error)"]);
	     								}

	     								//LOG REQUEST STOP
                                   }
                                   else{
                                        array_push($errorArray, ["error" => "one of the inputs is not a valid input (lietadlo)"]);
                                   }
     					}
     					else{
     						array_push($errorArray, ["error" => "one of the inputs is empty (lietadlo)"]);
     					}
     				}
     				else{
     					array_push($errorArray, ["error" => "not all inputs set (lietadlo)"]);
     				}
     			}
     			// LIETADLO STOP

     			//ERROR
     			else{
     				array_push($errorArray, ["error" => "bad type"]);
     			}

     		}
     		else{
     			array_push($errorArray, ["error" => "bad api key"]);
     		}
     	}
     	else{
     		array_push($errorArray, ["error" => "empty type or api key"]);
     	}
     }
     else{
     	array_push($errorArray, ["error" => "no api key or type set"]);
     }
}
// VLASTNY START
else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if($_GET["type"] == "vlastny"){

     	$inputPrikaz = "";

     	if(!isset($_POST["input"])){
     		array_push($errorArray, ["error" => "one of the inputs is empty (vlastny prikaz)"]);
     	}
     	else{
   			if(empty($_POST["input"])){
   				array_push($errorArray, ["error" => "not all inputs set (vlastny prikaz)"]);
   			}
   			else{
   				$inputPrikaz = $_POST["input"];
   			}
     	}
     	$commandToSend = 'octave --no-gui --persist --eval "'.$inputPrikaz.'"';
     	$out = exec($commandToSend);
     	array_push($dataArray, ["response" => $out]);

     	//LOG REQUEST START
     	$errorFlag = 0;
     	$errorDesc = "";
     	if(strlen($out)<1){
     		$errorFlag = 1;
     		$errorDesc = "Unexpected error occured while calling commands.";
     	}

     	if($stmt = $con->prepare('INSERT INTO caslogs(commands_sent,error_flag,error_description) VALUES(?,?,?)')){
     		$stmt->bind_param("sis",$inputPrikaz, $errorFlag, $errorDesc);
     		if($stmt->execute()){

     		}
     		else{
     			array_push($errorArray, ["error" => "cant log request (execute error - vlastny prikaz - $stmt->error)"]);
     		}
     	}
     	else{
     		array_push($errorArray, ["error" => "cant log request (prepare error - vlastny prikaz - $stmt->error)"]);
     	}

     	//LOG REQUEST STOP

    }
}
// VLASTNY STOP
else{
	array_push($errorArray, ["error" => "bad request method"]);
}

array_push($resultArray, ["data" => $dataArray]);
array_push($resultArray, ["final" => $finalArray]);
array_push($resultArray, ["error" => $errorArray]);

$resultJson =  json_encode($resultArray);
echo $resultJson;
//echo "<pre>";
//echo $resultJson;
//echo "</pre>";
?>