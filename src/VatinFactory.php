<?php

declare(strict_types=1);

namespace Eventjet\Vatin;

use Ddeboer\Vatin\Validator;

class VatinFactory
{
    /**
     * @phpstan-ignore-next-line keep the dependency for BC
     */
    public function __construct(?Validator $validator = null)
    {
    }

    public function create(string $number): VatinInterface
    {
        return new Vatin($number);
    }
}
