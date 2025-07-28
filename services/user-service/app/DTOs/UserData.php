<?php

namespace App\DTOs;

use App\Models\User;

class UserData
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
    ) {
    }

    public static function fromModel(User $user): self
    {
        return new self(
            $user->id,
            $user->name,
            $user->email,
        );
    }
}
