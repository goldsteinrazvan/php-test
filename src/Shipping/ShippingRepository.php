<?php

declare(strict_types=1);

namespace Shipping;

use Exception;

use Shipping\ZipCode;

class ShippingRepository
{   
    public function __construct()
    {
    }

     /**
     * @todo - add functionality to read and filter data file
     * 
     * Get historical data based on zip code and range
     * @param {ZipCode} $zip_code: zip code to get estimate for
     * @param {array} $range: date range for which historical data should be used
     * @return {array} array with historical data
     *
     */
    public function getHistoricalData(ZipCode $zip_code, array $range): array
    {   
      // check if array has range set
      if (!isset($range[0]) || !isset($range[1])) {
        throw new Exception('Invalid range submitted.');
      }

      $file_contents = file_get_contents(__DIR__.'/../../data/shipping.json');
      $data = json_decode($file_contents, true);
      
      $start_date = $range[0];
      $end_date = $range[1];

      $response = array_map(function ($item) use ($zip_code, $start_date, $end_date) {
        if ($item['zip_code'] == $zip_code->getZipCode()) {
          if ($item['shipment_date'] >= $start_date && $item['shipment_date'] <= $end_date) {
            return $item;
          }
        }
      }, $data);
      
      return $response;
    }

    /**
     * @todo - calculate average based on historical data
     * 
     * Get estimated delivery for given data
     * @param {array} $data: historical data that should be used
     * @return {string} date string with estimated delivery date 
     */
    public function getEstimate(array $data): string
    {
        return '';
    }
}
