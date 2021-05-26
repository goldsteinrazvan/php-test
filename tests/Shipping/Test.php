<?php

declare(strict_types=1);

namespace Tests\Shipping;

use PHPUnit\Framework\TestCase;
use Shipping\Controller as ShippingController;
use Shipping\ZipCode;

class Test extends TestCase
{
    public function testItGreetsUser(): void
    {   
        $shipping = new ShippingController();
        $this->assertSame('hello', $shipping->getEstimatedDelivery('213231'));
    }

    public function testZipCodes(): void
    {   
        $zip_code = new ZipCode();
        $this->assertSame(true, $zip_code->validateZipCode('89563-8733'));
        $this->assertSame(false, $zip_code->validateZipCode('12312321321'));
        $this->assertSame(false, $zip_code->validateZipCode('dsabcasdsa'));
    }
}
