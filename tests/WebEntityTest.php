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
        $this->assertSame($phone, $wEntity->getProperty("phone")[0]);
    }

    public function testAddServeralPropertiesSameKey(): void
    {
        $value1 = "223-5564-2";
        $value2 = "5573-233123";
        $value3 = "090088203-21";
        $wEntity = new WebEntity("http://www.myphotos.com/entity/6");
        $wEntity->addProperty("phone", $value1);
        $wEntity->addProperty("phone", $value2);
        $wEntity->addProperty("phone", $value3);

        $this->assertSame($value1, $wEntity->getProperty("phone")[0]);
        $this->assertSame($value2, $wEntity->getProperty("phone")[1]);
        $this->assertSame($value3, $wEntity->getProperty("phone")[2]);
    }

    public function testAddTwoKeysProperties(): void
    {
        $numberPhone = "223-5564-2";
        $photoAddress = "http://www.frontweb.com.br/my/photo.png";

        $wEntity = new WebEntity("http://booksite.com/my_entity/65");

        $wEntity->addProperty("phone", $numberPhone);
        $wEntity->addProperty("photo_address", $photoAddress);

        $this->assertSame($numberPhone, $wEntity->getProperty("phone")[0]);
        $this->assertSame($photoAddress, $wEntity->getProperty("photo_address")[0]);
    }
}
