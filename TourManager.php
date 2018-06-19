<?php

/*
* Lista de orase intr-un tur
*/
class TourManager
{
    // Array de orase
    private static $destinationCities = [];

    // Adauga oras de destinatie
    public static function addCity(City $city) {
        self::$destinationCities[] = $city;
    }

    // Extrage oras
    public static function getCity($index) {
        return self::$destinationCities[$index];
    }

    // Numarul de orase
    public static function numberOfCities() {
        return count(self::$destinationCities);
    }
}
