<?php 

namespace App\Entity;

class ScoutBee extends Bee
{
    public function __construct()
    {
        parent::__construct(30, 30, 15);
    }

    public function getType(): string
    {
        return 'Scout';
    }
}
