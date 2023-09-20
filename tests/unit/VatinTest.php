<?php

declare(strict_types=1);

namespace EventjetTest\Unit\Vatin;

use Eventjet\Vatin\Exception\InvalidVatinFormatException;
use Eventjet\Vatin\Vatin;
use PHPUnit\Framework\TestCase;

class VatinTest extends TestCase
{
    /**
     * @return list<array{0: string}>
     */
    public static function validNumbers(): array
    {
        return [
            ['NL123456789B01'],
            ['IE9574245O'],
        ];
    }

    /**
     * @return list<array{0: string}>
     */
    public static function invalidNumbers(): array
    {
        return [
            [''],
            ['123456789'],
            ['XX123'],
        ];
    }

    /**
     * @dataProvider validNumbers
     */
    public function testValidNumber(string $number): void
    {
        $vatin = new Vatin($number);

        self::assertSame($number, (string)$vatin);
    }

    /**
     * @dataProvider invalidNumbers
     */
    public function testCheckInvalidFormat(string $number): void
    {
        self::assertFalse(Vatin::checkFormat($number));
    }

    /**
     * @dataProvider validNumbers
     */
    public function testCheckValidFormat(string $number): void
    {
        self::assertTrue(Vatin::checkFormat($number));
    }

    /**
     * @dataProvider invalidNumbers
     */
    public function testInvalidNumber(string $number): void
    {
        $this->expectException(InvalidVatinFormatException::class);
        new Vatin($number);
    }
}
