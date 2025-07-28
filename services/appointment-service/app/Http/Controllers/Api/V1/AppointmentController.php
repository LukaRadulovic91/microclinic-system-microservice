<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ScheduleAppointmentRequest;
use App\Services\AppointmentService;
use Illuminate\Http\JsonResponse;

class AppointmentController extends Controller
{
    public function __construct(private AppointmentService $appointmentService)
    {
    }

    public function schedule(ScheduleAppointmentRequest $request): JsonResponse
    {
        $appointmentData = $request->validated();

        $appointment = $this->appointmentService->schedule($appointmentData);

        return response()->json([
            'message' => 'Appointment scheduled successfully',
            'data' => $appointment,
        ], 201);
    }
}
