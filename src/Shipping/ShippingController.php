<?php

declare(strict_types=1);

namespace Shipping;

use Exception;

use \Shipping\ZipCode;
use Shipping\ShippingRepository;

class ShippingController
{
    public function __construct()
    {
    }

    /**
     * @todo: add validation for range
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
        
        $shipping_repository = new ShippingRepository();
        
        $data = $shipping_repository->getHistoricalData($zip, $range);

        return $shipping_repository->getEstimate($data);
    }
}

