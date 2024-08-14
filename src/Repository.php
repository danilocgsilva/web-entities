<?php

declare(strict_types=1);

namespace Danilocgsilva\WebEntities;

use PDO;

class Repository
{
    private function __construct(private PDO $pdo) {}

    public function save(WebEntity $webEntity): self
    {
        $this->pdo->prepare("INSERT INTO entities VALUES ();");
        $entityId = $this->lastDbId();

        foreach ($webEntity->getProperties() as $propertyName => $value) {
            $this->pdo->prepare("INSERT INTO ")
        }
        
        return $this;
    }

    private function lastDbId(): string
    {
        $preResult = $this->pdo->prepare("SELECT LAST_INSERT_ID();");
        $preResult->execute();
        $preResult->setFetchMode(PDO::FETCH_NUM);
        $data = $preResult->fetch();
        return $data[0];
    }
}
