<?php
// outputs the username that owns the running php/httpd process
//// (on a system with the "whoami" executable in the path)
//echo exec('octave-cli --persist --eval "x = 1"');
//echo exec('x + 2');

//echo shell_exec("octave --no-gui --quiet octave_scripts/airplane.txt 0.2 0 0 0");
echo "<pre>";
//$output = shell_exec("octave --no-gui --quiet octave_scripts/kyvadlo.txt 0.2 0 0 0");
//echo preg_replace('!\s+!', ' ', $output);

$dataArray = array();

$octaveOutput = shell_exec("octave --no-gui --quiet octave_scripts/kyvadlo.txt 0.2 0 0");
$octaveOutput = preg_replace('!\s+!', ' ', $octaveOutput); //remove line breaks (turn into one line)

$outPut2Parts = explode("=END=", $octaveOutput); //array
$valuePairsArray = explode(" ", trim($outPut2Parts[0]));
$finalValuesArray = explode(" ", trim($outPut2Parts[1]));

$array_of_pairs = array();
while(sizeof($valuePairsArray) > 0){
    $data = ["pendulum_position" => $valuePairsArray[0], "pendulum_angle" => $valuePairsArray[1]];
    array_push($array_of_pairs, $data);

    array_shift($valuePairsArray); //shift twice to remove first 2 elements
    array_shift($valuePairsArray);
}


$finalPosition = $finalValuesArray[0];
$finalAngle = $finalValuesArray[2];
$array_of_final_values = ["finalPosition" => $finalPosition, "finalAngle" => $finalAngle];

$dataArray = ["position and angle" => $array_of_pairs, "final position and angle" => $array_of_final_values];


var_export($dataArray);
echo "</pre>";
?>