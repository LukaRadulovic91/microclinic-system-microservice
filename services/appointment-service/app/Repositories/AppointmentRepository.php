<?php

namespace App\Repositories;

use App\Models\Appointment;

class AppointmentRepository
{
    public function create(array $data): Appointment
    {
        return Appointment::create($data);
    }
}
