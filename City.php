<?php

/*
* Model pentru Oras
*/

class City
{
    const CITY_NUMBER = 200;

    public $x;
    public $y;

    // Construire oras la un x, y specific sau plasat aleator
    public function __construct($x = null, $y = null) {
        $this->x = $x ?: random_int(0, self::CITY_NUMBER - 1);
        $this->y = $y ?: random_int(0, self::CITY_NUMBER - 1);
    }

    // Gets city's x coordinate
    public function getX() {
        return $this->x;
    }

    // Gets city's y coordinate
    public function getY() {
        return $this->y;
    }

    // Gets the distance to given city
    public function distanceTo($city) {
        $xDistance = abs($this->getX() - $city->getX());
        $yDistance = abs($this->getY() - $city->getY());

        return round(sqrt(($xDistance * $xDistance) + ($yDistance * $yDistance)), 2);
    }

    public function __toString() {
        return $this->getX().', '.$this->getY();
    }
}
