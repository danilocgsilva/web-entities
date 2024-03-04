<?php

declare(strict_types=1);

namespace Danilocgsilva\WebEntitie\Migrations;

use PDO;

class Migrations
{
    public function __construct(private PDO $pdo) {}

    public function runString(string $string): void
    {
        $preResults = $this->pdo->prepare($string);
    }
}
