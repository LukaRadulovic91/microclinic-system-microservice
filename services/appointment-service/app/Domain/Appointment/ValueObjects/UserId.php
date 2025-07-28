<?php

namespace App\Domain\Appointment\ValueObjects;

use InvalidArgumentException;

class UserId
{
    public function __construct(private readonly int $value)
    {
        if ($value <= 0) {
            throw new InvalidArgumentException('User ID must be a positive integer.');
        }
    }

    public function value(): int
    {
        return $this->value;
    }
}
