<?php

namespace EventjetTest\Unit\Vatin;

use Ddeboer\Vatin\Validator;
use Ddeboer\Vatin\Vies\Client;
use Eventjet\Vatin\Exception\InvalidVatinFormatException;
use Eventjet\Vatin\Exception\VatinNotFoundException;
use Eventjet\Vatin\VatinFactory;
use Eventjet\Vatin\VatinInterface;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

class VatinFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var Validator|PHPUnit_Framework_MockObject_MockObject */
    private $validator;
    /** @var VatinFactory */
    private $factory;

    public function setUp()
    {
        $this->validator = $this->getMockBuilder(Validator::class)->getMock();
        $this->validator->method('getViesClient')->willReturn($this->mockViesClient());
        $this->factory = new VatinFactory($this->validator);
    }

    public function testFormatIsCheckedFirst()
    {
        $this->setExpectedException(InvalidVatinFormatException::class);
        $this->factory->create('invalid-number');
    }

    public function testCreateThrowsExceptionIfNumberDoesNotExist()
    {
        $this->validator->method('isValid')->willReturn(false);
        $this->setExpectedException(VatinNotFoundException::class);

        $this->factory->create('NL123456789B01');
    }

    public function testSuccessfulCreate()
    {
        $this->validator->method('isValid')->willReturn(true);
        $number = 'NL123456789B01';

        $vatin = $this->factory->create($number);

        $this->assertInstanceOf(VatinInterface::class, $vatin);
        $this->assertSame($number, (string)$vatin);
    }

    /**
     * @return Client|PHPUnit_Framework_MockObject_MockObject
     */
    private function mockViesClient()
    {
        return $this->getMockBuilder(Client::class)->getMock();
    }
}
