<?php

/*
* Creem un tur si evoluam pana la solutia problemei comis voiajorului
*/

class TSP_GA {
    public static function solve($evolveCount = 100) {
        // Creem si adaugam orase
        $city = new City(60, 200);
        TourManager::addCity($city);
        $city2 = new City(180, 200);
        TourManager::addCity($city2);
        $city3 = new City(80, 180);
        TourManager::addCity($city3);
        $city4 = new City(140, 180);
        TourManager::addCity($city4);
        $city5 = new City(20, 160);
        TourManager::addCity($city5);
        $city6 = new City(100, 160);
        TourManager::addCity($city6);
        $city7 = new City(200, 160);
        TourManager::addCity($city7);
        $city8 = new City(140, 140);
        TourManager::addCity($city8);
        $city9 = new City(40, 120);
        TourManager::addCity($city9);
        $city10 = new City(100, 120);
        TourManager::addCity($city10);
        $city11 = new City(180, 100);
        TourManager::addCity($city11);
        $city12 = new City(60, 80);
        TourManager::addCity($city12);
        $city13 = new City(120, 80);
        TourManager::addCity($city13);
        $city14 = new City(180, 60);
        TourManager::addCity($city14);
        $city15 = new City(20, 40);
        TourManager::addCity($city15);
        $city16 = new City(100, 40);
        TourManager::addCity($city16);
        $city17 = new City(200, 40);
        TourManager::addCity($city17);
        $city18 = new City(20, 20);
        TourManager::addCity($city18);
        $city19 = new City(60, 20);
        TourManager::addCity($city19);
        $city20 = new City(160, 20);
        TourManager::addCity($city20);

        // Initializam populatia
        $pop = new Population(50, true);
        echo "Distanta inititala: " . $pop->getFittest()->getDistance() . "<br>";

        // Evoluam numarul de generatii
        $pop = GA::evolvePopulation($pop);
        for ($i = 0; $i < $evolveCount; $i++) {
            $pop = GA::evolvePopulation($pop);
        }

        // Afisam rezultatul final
        echo "Finalizat" . "<br>";
        echo "Distanta finala : " . $pop->getFittest()->getDistance() . "<br>";
        echo "Solutia: " . "<br>";
        echo $pop->getFittest();
    }
}
