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
     * Get historical data based on zip code and range
     * 
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

      $response = array_filter($data, function ($item) use ($zip_code, $start_date, $end_date) {
        if ($item['zip_code'] == $zip_code->getZipCode()) {
          if ($item['shipment_date'] >= $start_date && $item['shipment_date'] <= $end_date) {
            return $item;
          }
        } 
      });
      
      return $response;
    }

    /**
     * Get estimated delivery duration for given data
     * @param {array} $data: data that should be used
     * @return {int} estimated duration in seconds
     */
    public function getEstimatedDuration(array $data): int
    {   
        if (count($data) < 1) {
          throw new Exception('Could not get estimated duration. Data set is empty.');
        } 

        $total = 0;

        for ($i = 0; $i < count($data); $i++) {
          $duration = $data[$i]['delivered_date'] - $data[$i]['shipment_date'];
          $total += $duration;
        }

        $estimated_duration = $total / count($data);

        return intval(round($estimated_duration));
    }
}
