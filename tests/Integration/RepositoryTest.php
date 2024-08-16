<?php

declare(strict_types=1);

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use Danilocgsilva\WebEntities\WebEntity;
use Danilocgsilva\WebEntities\Repository;
use PDO;

class RepositoryTest extends TestCase
{
    private PDO $pdo;

    private Repository $repository;
    
    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->pdo = new PDO(
            sprintf("mysql:host=%s;dbname=%s", getenv("DB_HOST_TEST"), getenv("DB_NAME_TEST")),
            getenv(""),
            $password
        );
    }
    
    public function testSaveEntity(): void
    {
        $entity = new WebEntity();

        $entity->addAlias("Juca");
    }
}
