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

    public function testGetHistoricalData(): void
    {   
      $zip_code = new ZipCode('72329');
      $repository = new ShippingRepository();

      $this->assertSame(count([]),count($repository->getHistoricalData($zip_code, [0, 1])));
    }
}
