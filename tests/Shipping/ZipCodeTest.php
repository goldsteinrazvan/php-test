<?php

declare(strict_types=1);

namespace Tests\Shipping;

use PHPUnit\Framework\TestCase;
use Shipping\ZipCode;

class ZipCodeTest extends TestCase
{
    public function testValidateZipCode(): void
    {   
        $zip_code = new ZipCode();
        $this->assertSame(true, $zip_code->validateZipCode('89563-8733'));
        $this->assertSame(false, $zip_code->validateZipCode('12312321321'));
        $this->assertSame(false, $zip_code->validateZipCode('dsabcasdsa'));
    }
}
