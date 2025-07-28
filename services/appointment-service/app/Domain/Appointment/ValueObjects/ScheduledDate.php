<?php

namespace App\Domain\Appointment\ValueObjects;

use App\Domain\Appointment\Exceptions\InvalidScheduledDateException;
use Carbon\Carbon;

class ScheduledDate
{
    public function __construct(private readonly Carbon $date)
    {
        if ($date->isPast()) {
            throw new InvalidScheduledDateException('Scheduled date must be in the future.');
        }
    }

    public function value(): Carbon
    {
        return $this->date;
    }

    public static function fromString(string $date): self
    {
        return new self(Carbon::parse($date));
    }
}
