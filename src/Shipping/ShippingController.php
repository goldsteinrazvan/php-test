<?php

declare(strict_types=1);

namespace Shipping;

use Exception;

use Shipping\ZipCode;
use Shipping\ShippingRepository;
use Shipping\Utils;

class ShippingController
{
    public function __construct()
    {
    }

    /**
     * @todo: add validation for range
     * @todo: if only one value is provided in range, set the start and end to last month (based on the value in range)
     * 
     * Get estimated delivery time based on a zip code and optional range
     * @param {string} $zip_code: zip code to get estimate for
     * @param {array} $range: date range for which historical data should be used
     * @return {string} date string with estimated delivery date
     */
    public function getEstimatedDelivery(string $zip_code, array $range = null): string 
    {   
        $zip = new ZipCode($zip_code);

        if (!$zip->isValid()) {
            throw new Exception('Invalid zip code submitted');
        }

        // if range is not set, default is now - 10 days
        if (!isset($range)) {
            $now = time();
            $from = $now - (10 * 24 * 60 * 60);

            $range = [];
            array_push($range, $from, $now);
        }
        
        $shipping_repository = new ShippingRepository();
        
        $data = $shipping_repository->getHistoricalData($zip, $range);
        
        $duration = $shipping_repository->getEstimatedDuration($data);
        
        $delivery_date = time() + $duration;

        return Utils::createDateString($delivery_date, 'Y-m-d');
    }
}

