<?php

header("Content-Type:application/json");

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
     				array_push($resultArray, ["kyvadlo" => "kyvadlo"]);
     			}
     			// KYVADLO STOP

     			// GULICKA START
     			else if($_GET["type"] == "gulicka"){
     				array_push($resultArray, ["gulicka" => "gulicka"]);
     			}
     			//GULICKA STOP

     			// TLMENIE START
     			else if($_GET["type"] == "tlmenie"){
     				array_push($resultArray, ["tlmenie" => "tlmenie"]);
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
                                        $output = preg_replace('!\s+!', ' ', $output);
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
                                        }
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

     			// VLASTNY START
     			else if($_GET["type"] == "vlastny"){
     				array_push($errorArray, ["vlastny" => "vlastny"]);
     			}
     			// VLASTNY STOP

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

array_push($resultArray, ["data" => $dataArray]);
array_push($resultArray, ["final" => $finalArray]);
array_push($resultArray, ["error" => $errorArray]);

$resultJson =  json_encode($resultArray);
echo $resultJson;

?>