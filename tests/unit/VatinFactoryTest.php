<?php

declare(strict_types=1);

namespace EventjetTest\Unit\Vatin;

use Ddeboer\Vatin\Validator;
use Ddeboer\Vatin\Vies\Client;
use Eventjet\Vatin\Exception\InvalidVatinFormatException;
use Eventjet\Vatin\VatinFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class VatinFactoryTest extends TestCase
{
    /** @var Validator&MockObject */
    private $validator;
    private VatinFactory $factory;

    protected function setUp(): void
    {
        $this->validator = $this->getMockBuilder(Validator::class)->getMock();
        $this->validator->method('getViesClient')->willReturn($this->mockViesClient());
        $this->factory = new VatinFactory($this->validator);
    }

    public function testFormatIsCheckedFirst(): void
    {
        $this->expectException(InvalidVatinFormatException::class);
        $this->factory->create('invalid-number');
    }

    public function testSuccessfulCreate(): void
    {
        $this->validator->method('isValid')->willReturn(true);
        $number = 'NL123456789B01';

        $vatin = $this->factory->create($number);

        self::assertSame($number, (string)$vatin);
    }

    /**
     * @return Client|MockObject
     */
    private function mockViesClient()
    {
        return $this->getMockBuilder(Client::class)->getMock();
    }
}
