<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Danilocgsilva\WebEntities\WebEntity;

class WebEntityTest extends TestCase
{
    public function testAddProperty(): void
    {
        $phone = "55-5545-2312";
        $wEntity = new WebEntity("http://www.dns.com/entity/1");
        $wEntity->addProperty("phone", $phone);
        $this->assertSame($phone, $wEntity->getProperty("phone"));
    }
}
