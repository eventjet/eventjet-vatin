<?php

namespace Eventjet\Vatin;

use Ddeboer\Vatin\Validator;

class VatinFactory
{
    /** @var Validator */
    private $validator;

    /**
     * VatinFactory constructor.
     *
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param string $number
     * @return VatinInterface
     */
    public function create($number)
    {
        return new Vatin($number);
    }
}
