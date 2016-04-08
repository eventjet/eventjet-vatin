<?php

namespace EventjetTest\Unit\Vatin;

use Eventjet\Vatin\Exception\InvalidVatinFormatException;
use Eventjet\Vatin\Vatin;
use PHPUnit_Framework_TestCase;

class VatinTest extends PHPUnit_Framework_TestCase
{
    public function validNumbers()
    {
        return [
            ['NL123456789B01'],
            ['IE9574245O'],
        ];
    }

    /**
     * @param string $number
     * @dataProvider validNumbers
     */
    public function testValidNumber($number)
    {
        $vatin = new Vatin($number);

        $this->assertSame($number, (string)$vatin);
    }

    public function invalidNumbers()
    {
        return [
            [null],
            [''],
            ['123456789'],
            ['XX123'],
        ];
    }

    /**
     * @param mixed $number
     * @dataProvider invalidNumbers
     */
    public function testInvalidNumber($number)
    {
        $this->expectException(InvalidVatinFormatException::class);
        new Vatin($number);
    }
}
