<?php

declare(strict_types=1);

namespace Danilocgsilva\WebEntities\Migrations;

use PDO;

class Migrate
{
    public function __construct(private PDO $pdo) {}

    /**
     * Run a sql expression
     *
     * @param string $string
     * @param array $placeholders
     * @return void
     */
    public function runString(string $string, array $placeholders = []): void
    {
        $preResults = $this->pdo->prepare($string);
        $preResults->execute($placeholders);
    }
}
