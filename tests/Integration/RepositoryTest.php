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
        $this->cleanTable('properties', 'aliases', 'entities');
        
        $this->assertSame(0, $this->countEntries('entities'));
        $entity = new WebEntity();
        $entity->addAlias("Juca");
        $this->repository->save($entity);
        $this->assertSame(1, $this->countEntries('entities'));
        $this->assertSame(1, $this->countEntries('aliases'));
    }

    public function testSeveralAliases(): void
    {
        $this->cleanTable('aliases', 'entities');

        $this->repository->save(
            (new WebEntity())
            ->addAlias("Robert, the king")
            ->addAlias("Robert, the poor man")
        );

        $this->assertSame(1, $this->countEntries('entities'));
        $this->assertSame(2, $this->countEntries('aliases'));
    }

    public function testSaveProperties(): void
    {
        $this->cleanTable('properties', 'aliases', 'entities');

        $this->repository->save(
            (new WebEntity())
            ->addAlias("Robert, the king")
            ->addProperty("phone", "443311-2345")
        );

        $this->assertSame(1, $this->countEntries('entities'));
        $this->assertSame(1, $this->countEntries('aliases'));
        $this->assertSame(1, $this->countEntries('properties'));
    }

    public function testDelete(): void
    {
        $this->cleanTable('properties', 'aliases', 'entities');

        $this->fillTable('entities', [[]]);
        $this->assertSame(1, $this->countEntries('entities'));
        $this->repository->delete(1);
        $this->assertSame(0, $this->countEntries('entities'));
    }

    public function testSeveralProperties(): void
    {
        $this->cleanTable('properties', 'aliases', 'entities');

        $this->repository->save(
            (new WebEntity())
            ->addAlias("Hebe")
            ->addProperty("phone", "6221-2332")
            ->addProperty("phone", "7742-4453")
            ->addProperty("phone", "3321-1212")
        );

        $this->assertSame(1, $this->countEntries('entities'));
        $this->assertSame(1, $this->countEntries('aliases'));
        $this->assertSame(3, $this->countEntries('properties'));
    }

    private function cleanTable(string ...$tablesName): void
    {
        foreach ($tablesName as $tableName) {
            $this->pdo
            ->prepare(sprintf("DELETE FROM %s;", $tableName))
            ->execute();
            $this->pdo
            ->prepare(sprintf("ALTER TABLE %s AUTO_INCREMENT = 1;", $tableName))
            ->execute();
        }
    }

    private function fillTable(string $tableName, array $values = []): void
    {
        foreach ($values as $valueKeyPairs) {
            $query = "";
            if (count($valueKeyPairs) === 0) {
                $query = sprintf("INSERT INTO %s VALUES ();", $tableName);
            } else {
                $keyArray = [];
                $valuesArray = [];
                foreach ($valueKeyPairs as $valueKeyPair) {
                    $keyArray[] = $valueKeyPair[0];
                    $valuesArray[] = $valueKeyPair[1];
                }

                $query = "INSERT INTO %s (" . 
                implode(", ", $keyArray) . 
                ") VALUES (" . 
                implode(", ", array_map(fn ($entry) => $this->escapeDbValues($entry), $valuesArray)) . 
                ");";
            }
            $this->pdo->prepare($query)->execute();
        }
    }

    private function escapeDbValues(array $values): string
    {
        return '"' . $values . '"';
    }

    private function countEntries(string $tableName): int
    {
        $preResults = $this->pdo->prepare(sprintf("SELECT COUNT(*) FROM %s;", $tableName));
        $preResults->setFetchMode(PDO::FETCH_NUM);
        $preResults->execute();
        return (int) $preResults->fetch()[0];
    }
}
