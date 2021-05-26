<?php

declare(strict_types=1);

namespace Shipping;

use Exception;

use Shipping\ZipCode;

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
        $zip = new ZipCode();

        $validZip = $zip->validateZipCode($zip_code);
        if (!$validZip) {
            throw new Exception('Invalid zip code submitted');
        }
        
        return $this->getEstimate($zip_code, $range);
    }

    /**
     * @todo - calculate average based on historical data
     * 
     * Get estimated delivery for given zip code and range
     * @param {string} $zip_code: zip code to get estimate for
     * @param {array} $range: date range for which historical data should be used
     * @return {string} date string with estimated delivery date 
     */
    private function getEstimate(string $zip_code, array $range): string
    {
        $data = $this->getHistoricalData($zip_code, $range);
        return '';
    }

    /**
     * @todo - add functionality to read and filter data file
     * 
     * Get historical data based on zip code and range
     * @param {string} $zip_code: zip code to get estimate for
     * @param {array} $range: date range for which historical data should be used
     * @return {array} array with historical data
     *
     */
    private function getHistoricalData(string $zip_code, array $range): array
    {
        $file_contents = file_get_contents(__DIR__.'/../../data/shipping.json');
        $data = json_decode($file_contents);
        return [];
    }
}
