<?php

namespace App\DTOs;

class AppointmentData
{
    public function __construct(
        public int $id,
        public readonly int $user_id,
        public readonly string $scheduled_for,
        public readonly ?string $notes = null,
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
