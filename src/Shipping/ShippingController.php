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
     * @todo: if only one value is provided in range, use the beginning and end of previous month.
     * the logic would be something like: 
     *  - extract current year from the provided value (a timestamp)
     *  - extract the current month from the provided value (a timestamp), return the numerical value of the month
     * 
     *  - previous_month = current month - 1, except if current month is 01 (January), then previous_month is 12 (December).
     *  - year = current year or current year - 1 if current month is 01 (January).
     * 
     *  - days_previous_month = get amount of days in previous_month (30/31 or 28/29 if month is February and depending if year is leap year)
     * 
     *  - range_start = timestamp for the 1st of previous_month of year, 
     *  - range_end = timestamp for days_previous_month of previous_month of year
     * 
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

