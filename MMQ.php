<?php
require_once('Matriz.php');
require_once('Gauss.php');
/**
 * Created by PhpStorm.
 * User: Kobayashi
 * Date: 12/11/2017
 * Time: 18:47
 */

class MMQ
{

    function fazMMQ($x,$y){
        $matriz = new Matriz();
        $gauss = new Gauss();
        $A1 = $this->fazA($x,1);
        $transposta = $matriz->transposta($A1);
        $A= $matriz->multiplicaMatrizes($transposta,$A1);
        $B = $matriz->multiplicaMatrizEVetor($transposta,$y);
        $coef = $gauss->ElGauss($A,$B);
        return $coef;
    }

    function fazA($x,$ordem){
        for ($i =0; $i<count($x);$i++){
            for ($j=0;$j<=$ordem;$j++){
                $A[$i][$j] = pow($x[$i],$ordem-$j);
            }
        }
        return $A;
    }


}