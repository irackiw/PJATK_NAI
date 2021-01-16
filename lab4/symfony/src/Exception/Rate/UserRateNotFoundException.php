<?php

namespace App\Exception\Rate;

use Throwable;

class UserRateNotFoundException extends \RuntimeException
{
    public function __construct(string $id, $code = 0, Throwable $previous = null)
    {
        parent::__construct(sprintf('User with id %s rates not found.', $id), $code, $previous);
    }
}