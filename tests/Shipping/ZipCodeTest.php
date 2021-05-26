<?php

declare(strict_types=1);

namespace Tests\Shipping;

use PHPUnit\Framework\TestCase;
use Shipping\ZipCode;

class ZipCodeTest extends TestCase
{
    public function testIsValid(): void
    {   
        $zip_code = new ZipCode('89563-8733');
        $this->assertSame(true, $zip_code->isValid());

        $invalid_zip = new ZipCode('dsadasdas');
        $this->assertSame(false, $invalid_zip->isValid());
    }
}
