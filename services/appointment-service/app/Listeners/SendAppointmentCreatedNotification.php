<?php

namespace App\Listeners;

use App\Events\AppointmentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAppointmentCreatedNotification implements ShouldQueue
{
    public function handle(AppointmentCreated $event): void
    {
        // Ovde ide slanje RabbitMQ poruke
        $appointment = $event->appointment;

        \Log::info('Appointment created: ', $appointment->toArray());

        // RabbitMQPublisher::publish('appointment.created', $appointment->toArray());
    }
}
