<?php

declare(strict_types=1);

namespace Eventjet\Vatin;

use Ddeboer\Vatin\Validator;

class VatinFactory
{
    private Validator $validator; // @phpstan-ignore-line keep the dependency for BC

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function create(string $number): VatinInterface
    {
        return new Vatin($number);
    }
}
