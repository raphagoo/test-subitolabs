<?php

namespace App\Entity;

abstract class Bee
{

    public function __construct(public int $hitPoints, public int $maxHitPoints, public int $damage)
    {
    }

    public function hit(): void
    {
        $this->hitPoints -= $this->damage;
        if ($this->hitPoints < 0) {
            $this->hitPoints = 0;
        }
    }

    public function isAlive(): bool
    {
        return $this->hitPoints > 0;
    }

    public function getHitPoints(): int
    {
        return $this->hitPoints;
    }
    
    public function getMaxHitPoints(): int
    {
        return $this->maxHitPoints;
    }

    abstract public function getType(): string;
}
