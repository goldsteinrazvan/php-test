<?php

declare(strict_types=1);

namespace Shipping;

class ZipCode
{   
    private string $zip;

    public function __construct(string $zip_code)
    {
      $this->zip = $zip_code;
    }
    
    public function getZipCode(): string
    {
      return $this->zip;
    }

    /**
     * Checks if a zip code exists
     * @param {string} zip_code
     * @return {boolval} true if zip code exists, otherwise false
     */
    public function isValid(): bool
    {
      $zip_codes = $this->loadZipCodes();
      return in_array($this->zip, $zip_codes);
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

