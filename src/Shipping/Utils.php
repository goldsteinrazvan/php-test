<?php

declare(strict_types=1);

namespace Shipping;

class Utils
{
    public function __construct()
    {
    }

    /**
     * Create date string from timestamp 
     * 
     * @param {int} $timestamp
     * @param {string} $format - optional, default is 'Y-m-d H:i:s'
     * @return {string} date string
     */
    public static function createDateString(int $timestamp, string $format = null)
    {
      $date_format = isset($format) ? $format : "Y-m-d H:i:s";
      return date($date_format, $timestamp);
    }
}

