<?php

namespace App\Services;

use App\DTOs\AppointmentData;
use App\Models\Appointment;
use App\Repositories\AppointmentRepository;

class AppointmentService
{
    public function __construct(private AppointmentRepository $appointmentRepository)
    {
    }

    /**
     * Schedule a new appointment.
     *
     * @param array $data
     * @return AppointmentData
     */
    public function schedule(array $data): AppointmentData
    {
        $appointment = $this->appointmentRepository->create($data);

        return new AppointmentData($appointment->toArray());
    }
}
