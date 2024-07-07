<?php

namespace App\Service;

interface GameServiceInterface
{
    public function hitRandomBee(array $bees): array;
    public function getBees(): array;
    public function resetGame(): void;
}