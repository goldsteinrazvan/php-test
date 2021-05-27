<?php

declare(strict_types=1);

namespace Tests\Shipping;

use PHPUnit\Framework\TestCase;
use Shipping\Utils;

class UtilsTest extends TestCase
{
    public function testCreateDateString(): void
    {   
        $this->assertSame('1970-01-01 00:00:00', Utils::createDateString(0));

        // 2021-05-05 10:00:00 UTC
        $this->assertSame('2021-05-05', Utils::createDateString(1620208800, 'Y-m-d'));
    }
}
