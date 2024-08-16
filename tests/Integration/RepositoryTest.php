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
            getenv("DB_USER_TEST"),
            getenv("DB_PASSWORD_TEST")
        );

        $this->repository = new Repository($this->pdo);
    }
    
    public function testSaveEntity(): void
    {
        $this->assertSame(0, $this->countEntries('entities'));
        $entity = new WebEntity();
        $entity->addAlias("Juca");
        $this->repository->save($entity);
        $this->assertSame(1, $this->countEntries('entities'));
    }

    private function countEntries(string $tableName): int
    {
        $preResults = $this->pdo->prepare(sprintf("SELECT COUNT(*) FROM %s;", $tableName));
        $preResults->setFetchMode(PDO::FETCH_NUM);
        $preResults->execute();
        return (int) $preResults->fetch()[0];
    }
}
