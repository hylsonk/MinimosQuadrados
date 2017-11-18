<?php
/**
 * Created by PhpStorm.
 * User: Kobayashi
 * Date: 17/11/2017
 * Time: 12:31
 */

namespace Classes;

use NumPHP\Core\NumArray;
use NumPHP\Core\NumPHP;
use NumPHP\LinAlg\LinAlg;

class MMQ
{
    public function calculaA(NumArray $vector, $grau = 1){
        $matrixA = NumPHP::zeros($vector->getSize(),$grau+1);
        for ($i = 0; $i <$vector->getSize();$i++){
            for($j = 0; $j<=$grau;$j++){
                $factor = 1;
                for ($k = 0; $k < $j; $k++){
                    $factor = $vector->get($i)->mult($factor);
                }
                $matrixA->set($i,$grau-$j,$factor);
            }

        }
        echo $matrixA;
        return $matrixA;
    }

    public function fazMMQ(NumArray $vectorX,NumArray $vectorY, $grau = 1){
        $matrizA = $this->calculaA($vectorX,$grau);
        $TA = $matrizA->getTranspose();
        $TB = $matrizA->getTranspose();
        $TA->dot($matrizA);
        $TB->dot($vectorY);

        $lin = LinAlg::inv($TA);
        $lin->dot($TB);
        echo $lin;
        return $lin;
    }

    public function geraPontosDaFuncao(NumArray $coef,$numPontos){
        for ($i = 0;$i < $numPontos; $i++){
            $Y = 0;
            for ($j = 0; $j < $coef->getSize(); $j++){
                $Y = $Y+(((float)$coef->get($j)->getData($j))*pow($i,$coef->getSize()-$j));
            }
            $pontos[$i] = $Y;
        }
//        print $coef->get(0)."*X + ".$coef->get(1);
        echo json_encode($pontos);
//        return $pontos;
    }
}