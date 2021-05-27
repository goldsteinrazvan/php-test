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

    public function testGetEstimatedDuration(): void 
    {   
        $repository = new ShippingRepository();

        $emptySet = [];

        try {
            $repository->getEstimatedDuration($emptySet);
            $this->fail('Expected exception for empty data set not thrown.');
        } catch (Exception $e) {
            $this->assertSame('Could not get estimated duration. Data set is empty.', $e->getMessage());
        }

        $dataSet1 = [
            [
                'zip_code' => '12345',
                'shipment_date' => 1,
                'delivered_date' => 2
            ],[
                'zip_code' => '12345',
                'shipment_date' => 1,
                'delivered_date' => 2
            ], [
                'zip_code' => '12345',
                'shipment_date' => 1,
                'delivered_date' => 2
            ]
        ];


        $this->assertSame(1, $repository->getEstimatedDuration($dataSet1));

        $dataSet2 = [
            [
                'zip_code' => '12345',
                'shipment_date' => 1,
                'delivered_date' => 2
            ],[
                'zip_code' => '12345',
                'shipment_date' => 3,
                'delivered_date' => 5
            ], [
                'zip_code' => '12345',
                'shipment_date' => 4,
                'delivered_date' => 8
            ],
            [
                'zip_code' => '12345',
                'shipment_date' => 7,
                'delivered_date' => 15
            ],
            [
                'zip_code' => '12345',
                'shipment_date' => 18,
                'delivered_date' => 30
            ]
        ];

        $this->assertSame(5, $repository->getEstimatedDuration($dataSet2));
    }
}
