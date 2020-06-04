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
                                   $initQ = $_GET["initQ"];
                                   $initTheta = $_GET["initTheta"];
                                   if(intval($initAlpha) >= 0 && intval($initQ) >= 0 && intval($initTheta) >= 0){
                                        $output = shell_exec("octave --no-gui --quiet octave_scripts/airplane.txt $r $initAlpha $initQ $initTheta");
                                        $frontAndEndValues = explode("====KONIEC====", $output);

                                        $frontValues = $frontAndEndValues[0];
                                        $endValues = $frontAndEndValues[1];

                                        $frontPieces = explode("||", $frontValues);
                                        for($i =0; $i<count($frontPieces); $i++){

                                             if(strlen($frontPieces[$i]) < 10){
                                                  break;
                                             }

                                             $insidePieces = explode("*", $frontPieces[$i]);

                                             $newFrame = array();

                                             $naklonLietadlaArray = explode(":", $insidePieces[0]);
                                             array_push($newFrame, ["naklon_lietadla" => $naklonLietadlaArray[1]]);

                                             $naklonZadnejKlapkyArray = explode(":", $insidePieces[1]);
                                             array_push($newFrame, ["naklon_zadnej_klapky" => $naklonZadnejKlapkyArray[1]]);

                                             array_push($dataArray, $newFrame);
                                        }

                                        if(strlen($endValues) > 10){
                                             $endPieces = explode("-", $endValues);
                                             for($i =0; $i<count($endPieces); $i++){
                                                  if(strlen($endPieces[$i]) < 10){
                                                     break; 
                                                     array_push($errorArray, ["error" => "unexpected result from Octave"]);
                                                  }
                                             }

                                             $initAlphaArray = explode(":", $endPieces[0]);
                                             array_push($finalArray, ["initAlpha" => $initAlphaArray[1]]);

                                             $initQArray = explode(":", $endPieces[1]);
                                             array_push($finalArray, ["initQ" => $initQArray[1]]);

                                             $initThetaArray = explode(":", $endPieces[2]);
                                             array_push($finalArray, ["initQ" => $initThetaArray[1]]);

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