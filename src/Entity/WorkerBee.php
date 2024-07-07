<?php

namespace App\Entity;

final class WorkerBee extends Bee
{
    public function __construct()
    {
        parent::__construct(50, 50, 20);
    }

    public function getType(): string
    {
        return 'Worker';
    }
}
