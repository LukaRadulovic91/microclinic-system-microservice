<?php

namespace App\DTOs;

class AppointmentData
{
    public function __construct(
        public int $id,
        public int $user_id,
        public string $scheduled_for,
        public ?string $notes = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['user_id'],
            $data['scheduled_for'],
            $data['notes'] ?? null
        );
    }
}
