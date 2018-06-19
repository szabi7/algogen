<?php

/*
* Populatia cu tururi candidate
*/
class Population
{
    // Populatie de tururi
    public $tours = [];

    // Constructor populatie
    public function __construct(int $populationSize, $initialise) {
        for ($i = 0; $i < $populationSize; $i++) {
            $this->tours[] = new Tour;
        }
        // Verificam daca avem nevoie sa initializam populatia cu tururi
        if ($initialise) {
            // Creem tururi
            for ($i = 0; $i < $this->populationSize(); $i++) {
                $newTour = new Tour;
                $newTour->generateIndividual();
                $this->saveTour($i, $newTour);
            }
        }
    }

    // Salvam un tur
    public function saveTour(int $index, Tour $tour) {
        $this->tours[$index] = $tour;
    }

    // Extragem un tur din populatie
    public function getTour(int $index) {
        return $this->tours[$index];
    }

    // Alegem cel mai bun tur din populatie
    public function getFittest() {
        $fittest = $this->tours[0];
        // Trecem prin fiecare pentru a detecta cel mai bun
        for ($i = 0; $i < $this->populationSize(); $i++) {
            if ($fittest->getFitness() <= $this->getTour($i)->getFitness()) {
                $fittest = $this->getTour($i);
            }
        }
        return $fittest;
    }

    // Extragem dimensiunea populatiei
    public function populationSize() {
        return count($this->tours);
    }
}
