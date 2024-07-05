<?php

namespace App\Service;

use App\Entity\QueenBee;
use App\Entity\WorkerBee;
use App\Entity\ScoutBee;
use App\Entity\Bee;

class GameService
{

    /**
     * @param array<Bee> $bees
     */
    public function __construct(private array $bees = [])
    {
        $this->bees[] = new QueenBee();
        for ($i = 0; $i < 5; $i++) {
            $this->bees[] = new WorkerBee();
        }
        for ($i = 0; $i < 8; $i++) {
            $this->bees[] = new ScoutBee();
        }
    }

    /**
     * @param array<Bee> $bees
     * @return array<Bee>
     */
    public function hitRandomBee(array $bees): array
    {
        /** @param Bee $bee  */
        $aliveBees = array_filter($bees, function ($bee) {
            return $bee->isAlive();
        });
    
        if (empty($aliveBees)) {
            $this->resetGame();
            return $this->bees;
        }
    
        $randomBee = $aliveBees[array_rand($aliveBees)];
        $randomBee->hit();
    
        // If the Queen bee is hit and dies, all bees lose their hit points.
        if (!$randomBee->isAlive() && $randomBee->getType() === 'Queen') {
            foreach ($bees as $bee) {
                $bee->hitPoints = 0; // Assuming hitPoints is the property to set to 0.
            }
        }
    
        return $bees; // Return the updated bees array.
    }

    public function resetGame(): void
    {
        $this->__construct();
    }

    /**
     * @return array<Bee>
     */
    public function getBees(): array
    {
        return $this->bees;
    }
}
