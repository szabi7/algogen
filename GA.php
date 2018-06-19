<?php

/*
* Algoritm pentru evoluarea populatiilor
*/

class GA
{
    /* parametri GA */
    private static $mutationRate = 0.015;
    private static $tournamentSize = 5;
    private static $elitism = true;

    // Evoluaria populatiei cu o generatie
    public static function evolvePopulation(Population $pop) {
        $newPopulation = new Population($pop->populationSize(), false);

        // pastram cel mai bun daca elitism este activat
        $elitismOffset = 0;
        if (self::$elitism) {
            $newPopulation->saveTour(0, $pop->getFittest());
            $elitismOffset = 1;
        }

        // populatie crossover
        // Trecem prin nou populatie si creez indivizi folosind vechea populatie
        for ($i = $elitismOffset; $i < $newPopulation->populationSize(); $i++) {
            // Alegem parintii
            $parent1 = self::tournamentSelection($pop);
            $parent2 = self::tournamentSelection($pop);
            // facem crossover din parinti
            $child = self::crossover($parent1, $parent2);
            // Adaugam copilul la populatie
            $newPopulation->saveTour($i, $child);
        }

        // Facem mutatie la 1 bit
        for ($i = $elitismOffset; $i < $newPopulation->populationSize(); $i++) {
            self::mutate($newPopulation->getTour($i));
        }

        return $newPopulation;
    }

    // Aplicam crossover la un set de parinti
    public static function crossover(Tour $parent1, Tour $parent2) {
        // Cream un nou tour copil
        $child = new Tour();

        // Obtinem pozitia de start si sfarsit pentru sub turul parintelui 1
        $startPos = random_int(0, $parent1->tourSize() - 1);
        $endPos = random_int(0, $parent1->tourSize() - 1);

        // Adaugam subturul parintelui 1 la copil
        for ($i = 0; $i < $child->tourSize(); $i++) {
            // In caz ca pozitia de start e mai mica de pozitia sfarsit
            if ($startPos < $endPos && $i > $startPos && $i < $endPos) {
                $child->setCity($i, $parent1->getCity($i));
            } // In caz ca pozitia de start e mai mare decat cea de sfarsit
            elseif ($startPos > $endPos) {
                if (!($i < $startPos && $i > $endPos)) {
                    $child->setCity($i, $parent1->getCity($i));
                }
            }
        }

        // Trecem prin turul parintelui 2
        for ($i = 0; $i < $parent2->tourSize(); $i++) {
            // Daca turul copilul nu are un anumit oras atunci il adaugam
            if (!$child->containsCity($parent2->getCity($i))) {
                // Cautam o pozitie libera in turul copilului
                for ($j = 0; $j < $child->tourSize(); $j++) {
                    // Daca gasim positia adaugam orasul
                    if ($child->getCity($j) == null) {
                        $child->setCity($j, $parent2->getCity($i));
                        break;
                    }
                }
            }
        }
        return $child;
    }

    // Mutatia unui tur prin functia swap
    private static function mutate(Tour $tour) {
        // Trecem prin orasele turului
        for($tourPos1 = 0; $tourPos1 < $tour->tourSize(); $tourPos1++){
            // Aplicam ratia mutatiei
            if (Helper::random_float() < self::$mutationRate) {
                // Obtinem o a doua pozitie aleatoare in tur
                $tourPos2 = random_int(0, $tour->tourSize() - 1);

                // Obtinem orasele din pozitia cea mai mare a turului
                $city1 = $tour->getCity($tourPos1);
                $city2 = $tour->getCity($tourPos2);

                // Inversam orasele
                $tour->setCity($tourPos2, $city1);
                $tour->setCity($tourPos1, $city2);
            }
        }
    }

    // Selectam tur candidat pentru crossover
    private static function tournamentSelection(Population $pop) {
        // Creem o populatia pentru tournament
        $tournament = new Population(self::$tournamentSize, false);
        // Pe fiecare pozitie din tournament alegem un candidat aleator si il adaugam
        for ($i = 0; $i < self::$tournamentSize; $i++) {
            $randomId = random_int(0, $pop->populationSize() - 1);
            $tournament->saveTour($i, $pop->getTour($randomId));
        }
        // Obtinem turul cel mai bun
        return $tournament->getFittest();
    }
}
