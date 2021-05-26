<?php

declare(strict_types=1);

namespace Tests\Shipping;

use Exception;

use PHPUnit\Framework\TestCase;
use Shipping\ShippingController;

class ShippingControllerTest extends TestCase
{
    public function testEstimatedDeliveryInvalidZipCode(): void
    {   
        try {
            $shipping = new ShippingController();
            $shipping->getEstimatedDelivery('213231');
            $this->fail('Expected exception for invalid zip code not thrown.');
        } catch (Exception $e) {
            $this->assertSame('Invalid zip code submitted', $e->getMessage());
        }
    }
}
