<?php

namespace Eventjet\Vatin;

use Ddeboer\Vatin\Validator;
use Eventjet\Vatin\Exception\VatinNotFoundException;

class VatinFactory
{
    /** @var Validator */
    private $validator;

    /**
     * VatinFactory constructor.
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param string $number
     * @return VatinInterface
     * @throws VatinNotFoundException
     */
    public function create($number)
    {
        $vies = new Vatin($number);
        if (!$this->validator->isValid($number, true)) {
            throw new VatinNotFoundException(sprintf('The VAT IN "%s" was not found in VIES.', $number));
        }
        return $vies;
    }
}
