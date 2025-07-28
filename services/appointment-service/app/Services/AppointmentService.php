<?php

namespace App\Services;

use Illuminate\Contracts\Events\Dispatcher;
use App\Models\Appointment;
use App\Repositories\AppointmentRepository;
use App\Events\AppointmentCreated;

class AppointmentService
{
    public function __construct(
        protected AppointmentRepository $repository,
        protected Dispatcher $dispatcher
    )
    {
    }

    /**
     * Schedule a new appointment.
     *
     * @param array $data
     * @return Appointment
     */
    public function schedule(array $data): Appointment
    {
        $appointment = new Appointment(
            id: new AppointmentId(0),
            userId: new UserId($data->user_id),
            scheduledFor: new ScheduledDate($data->scheduled_for),
            notes: $data->notes
        );

        $saved = $this->repository->save($appointment);

        $this->dispatcher->dispatch(new AppointmentCreated($saved));

        return $saved;
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
