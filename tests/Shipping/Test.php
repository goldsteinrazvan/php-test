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

    public function testZipCode(): void
    {   
        $zip_code = new ZipCode();
        $this->assertSame(false, $zip_code->checkZipCode('213231'));
    }
}
