<?php

namespace App\Repositories;

use App\Models\Appointment;
use App\Domain\Appointment\ValueObjects\AppointmentId;
use App\Models\Appointment as EloquentAppointment;

class AppointmentRepository
{
    public function create(array $data): Appointment
    {
        return Appointment::create($data);
    }

    public function save(Appointment $appointment): Appointment
    {
        $model = EloquentAppointment::updateOrCreate(
            ['id' => $appointment->toArray()['id'] ?: null],
            $appointment->toArray()
        );

        return new Appointment(
            id: new AppointmentId($model->id),
            userId: new \App\Domain\Appointment\ValueObjects\UserId($model->user_id),
            scheduledFor: new \App\Domain\Appointment\ValueObjects\ScheduledDate($model->scheduled_for),
            notes: $model->notes
        );
    }

    public function findById(AppointmentId $id): Appointment
    {
        $model = EloquentAppointment::findOrFail($id->value());

        return new Appointment(
            id: new AppointmentId($model->id),
            userId: new \App\Domain\Appointment\ValueObjects\UserId($model->user_id),
            scheduledFor: new \App\Domain\Appointment\ValueObjects\ScheduledDate($model->scheduled_for),
            notes: $model->notes
        );
    }
}
