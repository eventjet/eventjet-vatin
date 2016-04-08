<?php

namespace Eventjet\Vatin;

use Ddeboer\Vatin\Validator;
use Eventjet\Vatin\Exception\InvalidVatinFormatException;

class Vatin implements VatinInterface
{
    /** @var Validator */
    private static $validator;
    /** @var string */
    private $vatin;

    /**
     * Vatin constructor.
     *
     * Checks if the VAT identification number is correctly formatted. If it isn\'t, an exception is thrown.
     *
     * The constructor does NOT check if the VAT IN exists. It only checks the format. If you also want to check for the
     * existence, use the Eventjet\Vatin\VatinFactory instead.
     *
     * @param string $vatin
     * @throws InvalidVatinFormatException If the format is invalid
     */
    public function __construct($vatin)
    {
        if (!self::getValidator()->isValid($vatin, false)) {
            throw new InvalidVatinFormatException(sprintf(
                '"%s" is not a valid VAT identification number.',
                $vatin
            ));
        }
        $this->vatin = $vatin;
    }

    /**
     * @return Validator
     */
    private static function getValidator()
    {
        if (self::$validator === null) {
            self::$validator = new Validator;
        }
        return self::$validator;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->vatin;
    }
}
