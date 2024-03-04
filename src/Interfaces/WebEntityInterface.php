<?php

declare(strict_types=1);

namespace Danilocgsilva\WebEntities\Interfaces;

interface WebEntityInterface
{
    /**
     * Set the link for entity
     *
     * @param string $link
     * @return self
     */
    public function setLink(string $link): self;

    /**
     * Get the entity string link.
     *
     * @return string
     */
    public function getLink(): string;
}
