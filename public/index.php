<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Shipping\ShippingController;

$zip_codes = json_decode(file_get_contents(__DIR__.'/../data/zip_codes.json'), true);

$shipping = new ShippingController();

$estimatedDelivery = $shipping->getEstimatedDelivery($zip_codes[0]);

echo $estimatedDelivery;
