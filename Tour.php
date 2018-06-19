<?php

/*
* Clasa pentru o ruta canditata
*/
class Tour
{
    // Orasele din ruta
    private $tour = [];

    // Cache
    private $fitness = 0;
    private $distance = 0;

    // Contruire tur gol
    public function __construct($tour = null) {
        if ($tour) {
            $this->tour = $tour;
            return;
        }
        for ($i = 0; $i < TourManager::numberOfCities(); $i++) {
            $this->tour[] = null;
        }
    }

    // Create tur aleator
    public function generateIndividual() {
        // Trecem prin toate destinatiile posibile si le adaugam la tur
        for ($cityIndex = 0; $cityIndex < TourManager::numberOfCities(); $cityIndex++) {
            $this->setCity($cityIndex, TourManager::getCity($cityIndex));
        }
        // Reordonare tur in mod aleator
        shuffle($this->tour);
    }

    // Extrage oras din tur
    public function getCity(int $tourPosition) {
        return $this->tour[$tourPosition] ?? null;
    }

    // Adauga oras un tur pe anumita pozitie
    public function setCity(int $tourPosition, City $city) {
        $this->tour[$tourPosition] = $city;
        // Daca turul a fost modificat trebuie sa resetam fitness si distanta
        $this->fitness = 0;
        $this->distance = 0;
    }

    // Extrage valoare fitness
    public function getFitness() {
        if (!$this->fitness) {
            $this->fitness = 1 / round($this->getDistance(), 2);
        }
        return $this->fitness;
    }

    // Distanta totala a turului
    public function getDistance() {
        if (!$this->distance) {
            $tourDistance = 0;
            // Trecem prin toate orasele turului
            for ($cityIndex = 0; $cityIndex < $this->tourSize(); $cityIndex++) {
                // Extrage oras curent
                $fromCity = $this->getCity($cityIndex);
                // Orasul urmator
                $destinationCity;
                // Verificam daca suntem la ultimul oras
                // Daca da setam orasul destinatie acelasi cu primul oras
                if ($cityIndex + 1 < $this->tourSize()) {
                    $destinationCity = $this->getCity($cityIndex + 1);
                } else {
                    $destinationCity = $this->getCity(0);
                }
                // Obtinem distanta dintre cele doua orase
                $tourDistance += $fromCity->distanceTo($destinationCity);
            }
            $this->distance = $tourDistance;
        }

        return $this->distance;
    }

    // Numarul de orase in tur
    public function tourSize() {
        return count($this->tour);
    }

    // Verificam daca un oras este deja in tur
    public function containsCity(City $city) {
        return in_array($city, $this->tour, true);
    }

    public function __toString() {
        $geneString = "|";
        for ($i = 0; $i < $this->tourSize(); $i++) {
            $geneString .= $this->getCity($i)."|";
        }
        return $geneString;
    }
}
