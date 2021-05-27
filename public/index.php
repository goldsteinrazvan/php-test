<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Shipping\ShippingController;

$faker = Faker\Factory::create();

$zip_codes = json_decode(file_get_contents(__DIR__.'/../data/zip_codes.json'), true);

$shipping = new ShippingController();


$index = $faker->numberBetween(0, count($zip_codes) - 1);
$zip_code = $zip_codes[$index];
echo "Zip code is: $zip_code\n";

// no range given
$estimated_delivery_no_range = $shipping->getEstimatedDelivery($zip_code);
echo "Estimated delivery (no range given): $estimated_delivery_no_range\n";

// august-december 2020
$range = [1596240000, 1609459199];
$estimated_delivery = $shipping->getEstimatedDelivery($zip_code, $range);
echo "Estimated delivery (range august-december): $estimated_delivery\n";


// just starting month
$one_month_range = [];
$estimated_delivery_one_month = $shipping->getEstimatedDelivery($zip_code, $range);
echo "Estimated delivery (just starting month): $estimated_delivery\n";