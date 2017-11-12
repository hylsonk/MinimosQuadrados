<?php
/**
 * Created by PhpStorm.
 * User: Kobayashi
 * Date: 12/11/2017
 * Time: 18:47
 */

class Matriz
{
    /**
     * Gera a matriz transposta de $matriz
     * @param $matriz
     * @return $transposta
     */
    function transposta($matriz){
        for ($i = 0; $i<count($matriz);$i++){
            for ($j = 0; $j<count($matriz[0]);$j++){
                $transposta[$j][$i] = $matriz[$i][$j];
            }
        }
        return $transposta;
    }

    function multiplicaMatrizes($matrizA, $matrizB){
        for ($i = 0; $i<count($matrizA); $i++){
            for ($j = 0 ; $j<count($matrizB[0]); $j++) {
                $somatorio = 0;
                for($k = 0; $k<count($matrizA[0]); $k++){
                    $produto = $matrizA[$i][$k] * $matrizB[$k][$j];
                    $somatorio = $somatorio+$produto;
                }
                $result[$i][$j] = $somatorio;
            }

        }
        return $result;
    }

    function multiplicaMatrizEVetor($matriz, $vetor){
        for ($i = 0; $i<count($matriz); $i++){
            $somatorio = 0;
            for ($j =0;$j<count($vetor);$j++){
                $produto = $matriz[$i][$j]*$vetor[$j];
                $somatorio = $somatorio+$produto;
            }
            $result[$i] = $somatorio;

        }
        return $result;
    }


}