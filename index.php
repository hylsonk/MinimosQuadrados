<?php
require_once ("MMQ.php");
/**
 * Created by PhpStorm.
 * User: Kobayashi
 * Date: 12/11/2017
 * Time: 18:56
 */

for($i = 0; $i<20; $i++){
    $x = rand(1,15);
    $y = rand(0,44);
    $X[$i] = $x;
    $Y[$i] = $y;
}
//
//print "<pre>";
//print_r($X);
//print_r($Y);
//print "</pre>";

$mmq = new MMQ();

$a  = [-1,0,1,2];
$b  = [0,1,2,1];

$coeficientes = $mmq->fazMMQ($a,$b,1);

echo json_encode($coeficientes);
