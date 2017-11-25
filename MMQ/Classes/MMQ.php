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

    /**
     * Função que faz o calculo da Matriz A apartir do vetor dos valores das coordenadas X dos pontos
     *
     * A = [x0 1]
     *     [x1 1]
     *     [x2 1]
     *     [x3 1]
     *     [x4 1]
     *
     *
     * @param NumArray $vector
     * @param int $grau
     * @return NumArray
     */
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
        return $matrixA;
    }


    /**
     * Faz o metodo de Minimos Quadrados apartir da entrada dos valores das coordenadas X e Y.
     * Como o metodo é feito de uma função exponencial é necessario fazer a coversão da formula Y = Ae^(Bx) para ln(Y) = Ln(A) +Bx
     *
     * @param NumArray $vectorX
     * @param NumArray $vectorY
     * @param int $grau
     * @return NumArray
     */
    public function fazMMQ(NumArray $vectorX, NumArray $vectorY, $grau = 1){
//        Transforma o vetorX numa Matriz de potencias
        $matrizA = $this->calculaA($vectorX,$grau);

//        Faz Ln(Y)
        $lnY = \NumPHP\Core\NumPHP::zeros($vectorY->getSize());
        for ($i = 0 ; $i < $vectorY->getSize(); $i++){
            $lnY->set($i, log($vectorY->get($i)->getData()));
        }

//        Multiplica a matrizA e os seus pontos correspondentes Ln(Y) pela transposta da matrizA gerando TA e TB
        $TA = $matrizA->getTranspose();
        $TB = $matrizA->getTranspose();
        $TA->dot($matrizA);
        $TB->dot($lnY);

//        Resolve o sistema linear TA x = TB
        $lin = LinAlg::solve($TA,$TB);;

//        Antes de devolver o vetor de coeficientes encontrado no sistema linear precisa fazer o passo inverso de Ln que foi usado na conversão
        $lin->set(1,exp($lin->get(1)->getData()));

        return $lin;
    }


    /**
     * Função que retorna os valores da função encontrada com os coeficientes retornados do fazMMQ
     * O padrão de retorno é um vetor onde a posição corresponde ao valor de X e o valor de Y
     *
     * Y = A*e^(B*X)
     * pontos[X] = Y;
     *
     * Sendo que X precisa está num intervalo de 0 à $numPontos
     *
     * O retorno é um JSON dos pontos que será consumido pelo aplicativo
     * @param NumArray $coef
     * @param $numPontos
     */
    public function geraPontosDaFuncao(NumArray $coef, $numPontos){
        for ($i = 0;$i < $numPontos; $i++){
            $Y = $coef->get(1)->getData()*exp($i*$coef->get(0)->getData());
            $pontos[$i] = $Y;
        }

        echo json_encode($pontos);
    }
}