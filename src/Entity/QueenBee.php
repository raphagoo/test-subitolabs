<?php

namespace App\Entity;

final class QueenBee extends Bee
{
    public function __construct()
    {
        parent::__construct(100, 100, 15);
    }

    public function getType(): string
    {
        return 'Queen';
    }
}