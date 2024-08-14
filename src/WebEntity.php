<?php

declare(strict_types=1);

namespace Danilocgsilva\WebEntities;

class WebEntity
{
    private array $properties = [];
    
    public function __construct(public string $address) {}

    /**
     * Add an arbitrary property for entity.
     *
     * @param string $propertyName
     * @param string $propertyValue
     * @return WebEntity
     */
    public function addProperty(string $propertyName, string $propertyValue): WebEntity
    {
        $this->properties[$propertyName][] = $propertyValue;
        return $this;
    }

    /**
     * Fetches the value from a arbitrary property previously given.
     *
     * @param string $propertyName
     * @return string
     */
    public function getProperty(string $propertyName): array
    {
        return $this->properties[$propertyName];
    }

    public function getProperties(): array
    {
        return $this->properties;
    }
}
