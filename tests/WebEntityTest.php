<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Danilocgsilva\WebEntities\WebEntity;

class WebEntityTest extends TestCase
{
    private WebEntity $testingWebEntity;
    
    public function setUp(): void
    {
        $this->testingWebEntity = new WebEntity();
    }

    
    public function testAddProperty(): void
    {
        $phone = "55-5545-2312";
        $this->testingWebEntity->addProperty("phone", $phone);
        $this->assertSame($phone, $this->testingWebEntity->getProperty("phone")[0]);
    }

    public function testAddServeralPropertiesSameKey(): void
    {
        $value1 = "223-5564-2";
        $value2 = "5573-233123";
        $value3 = "090088203-21";
        $this->testingWebEntity->addProperty("phone", $value1);
        $this->testingWebEntity->addProperty("phone", $value2);
        $this->testingWebEntity->addProperty("phone", $value3);

        $this->assertSame($value1, $this->testingWebEntity->getProperty("phone")[0]);
        $this->assertSame($value2, $this->testingWebEntity->getProperty("phone")[1]);
        $this->assertSame($value3, $this->testingWebEntity->getProperty("phone")[2]);
    }

    public function testAddTwoKeysProperties(): void
    {
        $numberPhone = "223-5564-2";
        $photoAddress = "http://www.frontweb.com.br/my/photo.png";

        $this->testingWebEntity->addProperty("phone", $numberPhone);
        $this->testingWebEntity->addProperty("photo_address", $photoAddress);

        $this->assertSame($numberPhone, $this->testingWebEntity->getProperty("phone")[0]);
        $this->assertSame($photoAddress, $this->testingWebEntity->getProperty("photo_address")[0]);
    }

    public function testAliases(): void
    {
        $alias1 = "Robert, the king";
        $alias2 = "Robert, the poor man";
        $this->testingWebEntity->addAlias($alias1);
        $this->testingWebEntity->addAlias($alias2);

        $this->assertCount(2, $this->testingWebEntity->getAliases());
    }
}
