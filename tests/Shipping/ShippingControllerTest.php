<?php

declare(strict_types=1);

namespace Tests\Shipping;

use Exception;

use PHPUnit\Framework\TestCase;
use Shipping\ShippingController;
use Shipping\ShippingRepository;
use Shipping\ZipCode;
use Shipping\Utils;

class ShippingControllerTest extends TestCase
{
    public function testEstimatedDelivery(): void
    {   
        $shipping = new ShippingController();
        $repository = new ShippingRepository();
        $zip_codes = json_decode(file_get_contents(__DIR__.'/../../data/zip_codes.json'), true);
        
        // test invalid zip code
        try {
            $shipping->getEstimatedDelivery('213231');
            $this->fail('Expected exception for invalid zip code not thrown.');
        } catch (Exception $e) {
            $this->assertSame('Invalid zip code submitted', $e->getMessage());
        }

        // test default range
        $zip_code = new ZipCode($zip_codes[0]);

        $now = time();
        $start = $now - (10 * 24 * 60 * 60);
        $range = [$start, $now];

        $data = $repository->getHistoricalData($zip_code, $range);
        $estimated_duration = $repository->getEstimatedDuration($data);
        $delivery_date = Utils::createDateString($now + $estimated_duration, 'Y-m-d');

        $this->assertSame($delivery_date, $shipping->getEstimatedDelivery($zip_codes[0]));
    }
}
