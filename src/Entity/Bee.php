<?php

namespace App\Entity;

abstract class Bee
{

    public function __construct(public int $hitPoints, public int $maxHitPoints, public int $damage)
    {
    }

    final public function hit(): void
    {
        $this->hitPoints -= $this->damage;
        if ($this->hitPoints < 0) {
            $this->hitPoints = 0;
        }
    }

    final public function isAlive(): bool
    {
        return $this->hitPoints > 0;
    }

    final public function getHitPoints(): int
    {
        return $this->hitPoints;
    }
    
    final public function getMaxHitPoints(): int
    {
        return $this->maxHitPoints;
    }

    abstract public function getType(): string;
}
