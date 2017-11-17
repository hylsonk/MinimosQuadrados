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
    private $coef;

    function fazMMQ($x,$y,$grau){
        $matriz = new Matriz();
        $gauss = new Gauss();
        $A1 = $this->fazA($x,$grau);
        $transposta = $matriz->transposta($A1);
        $A= $matriz->multiplicaMatrizes($transposta,$A1);
        $B = $matriz->multiplicaMatrizEVetor($transposta,$y);
//        echo "<pre>";
//        echo count($A1);
//        echo "</pre>";
//        echo "<pre>";
//        echo count($B);
//        echo "</pre>";
//        echo "<pre>";
//        echo count($A);
//        echo "</pre>";
        $coef = $gauss->ElGauss($A,$B);

        $pontos = new ArrayObject();
        for ($i = 0; $i < 16; $i++){
//            json_encode(new Ponto($i,$this->funcao($coef,$grau,$i)));
            $pontos[] = $this->funcao($coef,$grau,$i);
        }

//        $this->printFuncao($coef,$grau);

        return $pontos;
    }

    function fazA($x,$grau){
        for ($i =0; $i<count($x);$i++){
            for ($j=0;$j<=$grau;$j++){
                $A[$i][$j] = pow($x[$i],$grau-$j);
            }
        }
        return $A;
    }

    function printFuncao($coef,$grau){
        $funcao = "y =";
        print $funcao;
        for ($i = 0; $i<=$grau;$i++){
            print $coef[$grau-$i];
            print "x^(".($i).")+";
        }
        print "<br>";
    }

    function funcao($coef,$grau,$x){
        $y = 0;
        for ($i = 0; $i<=$grau;$i++){
            $y = $coef[$grau-$i]*pow($x,$i);
        }
        return $y;
    }


}