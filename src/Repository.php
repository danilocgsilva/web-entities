<?php

declare(strict_types=1);

namespace Danilocgsilva\WebEntities;

use PDO;
use Danilocgsilva\WebEntities\WebEntity;

class Repository
{
    private WebEntity $savingWebEntity;

    private int $entityId;

    public function __construct(private PDO $pdo) {}

    public function save(WebEntity $webEntity): self
    {
        $this->savingWebEntity = $webEntity;
        $this->writeEntityTable();
        $this->writeAliasesTable();
        $this->writePropertiesTable();
        
        return $this;
    }

    public function delete(int $entityId): void
    {
        $preResult = $this->pdo->prepare("DELETE FROM entities WHERE id = :entity_id;");
        $preResult->execute([':entity_id' => $entityId]);
    }

    private function writeEntityTable(): self
    {
        $preResult = $this->pdo->prepare("INSERT INTO `entities` VALUES ();");
        $preResult->execute();
        $this->entityId = $this->getLastDbId();
        return $this;
    }

    private function writeAliasesTable(): self
    {
        foreach ($this->savingWebEntity->getAliases() as $alias) {
            $preResult = $this->pdo->prepare("INSERT INTO `aliases` (`name`, `entity_id`) VALUES (:name, :entity_id)");
            $preResult->execute([
                ':name' => $alias,
                ':entity_id' => $this->entityId,
            ]);
        }
        return $this;
    }

    private function writePropertiesTable(): self
    {
        foreach ($this->savingWebEntity->getProperties() as $key => $propertyValue) {
            
            foreach ($propertyValue as $unitValue) {
                $preResults = $this->pdo->prepare("INSERT INTO properties (`values`, `entity_id`, `property_name`) VALUES (:values, :entity_id, :property_name);");
                $preResults->execute([
                    ':values' => $unitValue,
                    ':entity_id' => $this->entityId,
                    ':property_name' => $key
                ]);                
            }
        }
        return $this;
    }

    private function getLastDbId(): int
    {
        $preResult = $this->pdo->prepare("SELECT LAST_INSERT_ID();");
        $preResult->execute();
        $preResult->setFetchMode(PDO::FETCH_NUM);
        $data = $preResult->fetch();
        return (int) $data[0];
    }
}
