<?php

declare(strict_types=1);

namespace Tests\Shipping;

use Exception;

use PHPUnit\Framework\TestCase;
use Shipping\ShippingRepository;
use Shipping\ZipCode;

class ShippingRepositoryTest extends TestCase
{
    public function testGetHistoricalDataInvalidRange(): void
    {   
        try {
            $zip_code = new ZipCode('123456');
            $repository = new ShippingRepository();
            $repository->getHistoricalData($zip_code, []);
            $this->fail('Expected exception for invalid zip code not thrown.');
        } catch (Exception $e) {
            $this->assertSame('Invalid range submitted.', $e->getMessage());
        }
    }
}
