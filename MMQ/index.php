<?php
require_once("vendor/autoload.php");
/**
 * Created by PhpStorm.
 * User: Kobayashi
 * Date: 12/11/2017
 * Time: 18:56
 *
 * O projeto tem o objetivo de usar o metodo de minimos quadrados com dados de periodos e quantas disciplinas foram
 * concluidas por todos so alunos que usam o aplicativo Minha Grade. O resultado desse metodo será exibido numa area
 * do aplicativo onde o usuario terá um auxilio visual(grafico) de como ele está em relação aos demais alunos
 *
 * Para auxiliar as operações com matrizes foi usado uma biblioteca chamada NumPHP que possui limitações de funcionalidades
 */



//Chama a Classe MMQ
$mmq = new \Classes\MMQ();

//Vetor com os valores das coordenadas x que correspondem aos periodos
$vectorA = new \NumPHP\Core\NumArray(
//    [1,1,1,2,2,2,2,3,3,3,3,3,4,4,4,4,5,5,5,5,5,5,6,6,6,7,7,7,8,8,9,9,10,10,11,12,13,14]
    [1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 3, 3, 3, 3, 3, 3, 4, 4, 4, 4,
        4, 4, 5, 5, 5, 5, 5, 5, 6, 6, 6, 7, 7, 7, 8, 8, 9, 9, 10, 10,
        11, 12, 13, 14]
);



//Vetor com os valores das coordenadas y que correspondem a quantidade de disciplinas concluidas correspondente aos periodos no Vetor A
$vectorB = new \NumPHP\Core\NumArray(
//    [5,4,3,9,10,8,7,14,12,16,11,9,18,13,21,11,23,13,26,15,19,11,14,23,11,15,26,12,16,15,16,18,19,21,22,26,17,31]
    [5, 5, 3, 4, 4, 5, 9, 9, 7, 8, 8, 10, 14, 12, 9, 12, 11, 16, 18, 13,
        11, 13, 13, 21, 23, 13, 11, 19, 15, 26, 14, 11, 23, 15, 12, 26, 16,
        15, 16, 18, 19, 21, 22, 26, 27, 31]
);



//Calcula os coeficientes da função relativa gerada pelo MMQ
$coef = $mmq->fazMMQ($vectorA,$vectorB,1);
echo $coef;

//Executa a função apartir dos coeficientes calculados retornando um numero de pontos
$mmq->geraPontosDaFuncao($coef,20);
