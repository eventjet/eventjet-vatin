<?php

declare(strict_types=1);

namespace Eventjet\Vatin;

use Ddeboer\Vatin\Validator;
use Eventjet\Vatin\Exception\InvalidVatinFormatException;

use function sprintf;

class Vatin implements VatinInterface
{
    private string $vatin;
    private static Validator|null $validator = null;

    /**
     * Checks if the VAT identification number is correctly formatted. If it isn\'t, an exception is thrown.
     *
     * The constructor does NOT check if the VAT IN exists. It only checks the format. If you also want to check for the
     * existence, use the {@see \Eventjet\Vatin\VatinFactory} instead.
     *
     * @throws InvalidVatinFormatException If the format is invalid
     */
    public function __construct(string $vatin)
    {
        if (!self::checkFormat($vatin)) {
            throw new InvalidVatinFormatException(
                sprintf(
                    '"%s" is not a valid VAT identification number.',
                    $vatin,
                ),
            );
        }
        $this->vatin = $vatin;
    }

    public static function checkFormat(string $vatin): bool
    {
        return self::getValidator()->isValid($vatin);
    }

    private static function getValidator(): Validator
    {
        if (self::$validator === null) {
            self::$validator = new Validator();
        }
        return self::$validator;
    }

    public function __toString(): string
    {
        return $this->vatin;
    }
}
