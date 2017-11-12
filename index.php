<?php
require_once ("MMQ.php");
/**
 * Created by PhpStorm.
 * User: Kobayashi
 * Date: 12/11/2017
 * Time: 18:56
 */

$mmq = new MMQ();

$a  = [-1,0,1,2];
$b  = [0,1,2,1];

print "<pre>";
print_r($mmq->fazMMQ($a,$b));
print "</pre>";