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
    public function validNumbers(): array
    {
        return [
            ['NL123456789B01'],
            ['IE9574245O'],
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
     * @return list<array{0: string}>
     */
    public function invalidNumbers(): array
    {
        return [
            [''],
            ['123456789'],
            ['XX123'],
        ];
    }

    /**
     * @param mixed $number
     * @dataProvider invalidNumbers
     */
    public function testInvalidNumber($number): void
    {
        $this->expectException(InvalidVatinFormatException::class);
        new Vatin($number);
    }
}
