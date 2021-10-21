<?php

declare(strict_types=1);

namespace Eventjet\Vatin;

interface VatinInterface
{
    /**
     * @return string
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingNativeTypeHint
     */
    public function __toString();
}
