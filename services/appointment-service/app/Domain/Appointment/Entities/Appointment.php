<?php

namespace App\Domain\Appointment\Entities;

use App\Domain\Appointment\ValueObjects\AppointmentId;
use App\Domain\Appointment\ValueObjects\UserId;
use App\Domain\Appointment\ValueObjects\ScheduledDate;

class Appointment
{
    public function __construct(
        private readonly AppointmentId $id,
        private UserId $userId,
        private ScheduledDate $scheduledFor,
        private ?string $notes = null,
    ) {}

    public function reschedule(ScheduledDate $newDate): void
    {
        $this->scheduledFor = $newDate;
    }

    public function getUserId(): int
    {
        return $this->userId->value();
    }

    public function getScheduledDate(): string
    {
        return $this->scheduledFor->value()->toDateTimeString();
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    // Optionally map to persistence format
    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'user_id' => $this->userId->value(),
            'scheduled_for' => $this->scheduledFor->value()->toDateTimeString(),
            'notes' => $this->notes,
        ];
    }
}
