<?php

declare(strict_types=1);

namespace Shipping;

use Shipping\ZipCode;

class Controller
{
    public function __construct()
    {
    }

    /**
     * @todo: get estimated delivery time 
     * 
     * Get estimated delivery time based on a zip code
     * @param {string} $zip_code: zip code to get estimate for
     * @param {array} $range: date range for which historical data should be used
     * @return {string} date string with estimated delivery date
     */
    public function getEstimatedDelivery(string $zip_code, array $range = null): string 
    {   
        // @todo - check if zip codes exist, otherwise return error
        // @todo - load historical data
        // @todo - filter historical data based on zip code and range
        // @todo - get estimated delivery
        // @todo - return date string estimated delivery time
        return 'hello';
    }
}
