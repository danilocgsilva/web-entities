<?php

declare(strict_types=1);

namespace Danilocgsilva\WebEntities\Interfaces;

use Danilocgsilva\WebEntities\Interfaces\WebEntityInterface;

interface WebEntityRepositoryInterface
{
    /**
     * Persists in database the given entity.
     *
     * @param WebEntityInterface $webEntity
     * @return void
     */
    public function save(WebEntityInterface $webEntity): void;
}
