<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\AppointmentCreated;
use App\Listeners\SendAppointmentCreatedNotification;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        AppointmentCreated::class => [
            SendAppointmentCreatedNotification::class,
        ],
    ];
}
