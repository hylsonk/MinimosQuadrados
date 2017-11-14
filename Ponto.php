<?php
/**
 * Created by PhpStorm.
 * User: Kobayashi
 * Date: 13/11/2017
 * Time: 21:08
 */

class Ponto
{
    private $x;
    private $y;
    /**
     * Ponto constructor.
     */
    public function __construct($x,$y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param mixed $x
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param mixed $y
     */
    public function setY($y)
    {
        $this->y = $y;
    }

}