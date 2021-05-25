<?php 

require_once '../vendor/autoload.php';

$faker = Faker\Factory::create();

$zip_codes = [];

$data = [];

// generate random zip codes
for ($i = 0; $i < 10; $i++) {
  array_push($zip_codes, $faker->postcode());
}

// write zip codes to json file in order to use later in tests
$file_zip_codes = fopen('../data/zip_codes.json', 'w');
fwrite($file_zip_codes, json_encode($zip_codes));
fclose($file_zip_codes);

// generate random shipping data for zip codes
$entries = $faker->numberBetween(5000, 9999);

echo "Generating $entries entries for shipping data\n";

for ($i = 0; $i < $entries; $i++) {
  $index = $faker->numberBetween(0, count($zip_codes) - 1);
  $zip_code = $zip_codes[$index];

  $delivery_time = $faker->numberBetween(3, 14);
  $interval = "P".$delivery_time."D";

  $shipping_date = $faker->dateTimeBetween('-1 year');
  $delivery_date = clone $shipping_date;
  $delivery_date = $delivery_date->add(new DateInterval($interval));

  $entry = array(
    'zip_code' => $zip_code,
    'shipment_date' => $shipping_date->getTimestamp(),
    'delivered_date' => $delivery_date->getTimestamp()
  );

  array_push($data, $entry);
}

// write data to json file and store it
$file_shipping_data = fopen('../data/shipping.json', 'w');
fwrite($file_shipping_data, json_encode($data));
fclose($file_shipping_data);
