<?php

declare(strict_types=1);

namespace Shipping;

class ZipCode
{
    public function __construct()
    {
    }

    /**
     * Checks if a zip code exists
     * @param {string} zip_code
     * @return {boolval} true if zip code exists, otherwise false
     */
    public function validateZipCode(string $zip_code): bool
    {
      $zip_codes = $this->loadZipCodes();
      return in_array($zip_code, $zip_codes);
    }

    /**
     * Get existing zip codes
     * @return - array with existing zip codes
     */
    private function loadZipCodes(): array 
    { 
      $data = file_get_contents(__DIR__.'/../../data/zip_codes.json');
      return json_decode($data);
    }
}

