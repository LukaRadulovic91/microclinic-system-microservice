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
        $appointment = new Appointment(
            id: new AppointmentId(0),
            userId: new UserId($data->user_id),
            scheduledFor: new ScheduledDate($data->scheduled_for),
            notes: $data->notes
        );

        return $this->repository->save($appointment);
    }

    /**
     * Reschedule an appointment.
     *
     * @param int $id
     * @param string $newDate
     *
     * @return Appointment
     */
    public function reschedule(int $id, string $newDate): Appointment
    {
        $appointment = $this->repository->findById(new AppointmentId($id));

        $appointment->reschedule(new ScheduledDate($newDate));

        return $this->repository->save($appointment);
    }
}
