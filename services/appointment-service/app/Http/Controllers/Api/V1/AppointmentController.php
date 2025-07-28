<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ScheduleAppointmentRequest;
use App\Services\AppointmentService;
use App\DTOs\AppointmentData;

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

    public function store(ScheduleAppointmentRequest $request)
    {
        $data = new AppointmentData(
            user_id: $request->user()->id,
            scheduled_for: $request->input('scheduled_for'),
            notes: $request->input('notes')
        );

        $appointment = $this->appointmentService->schedule($data);

        return response()->json($appointment->toArray(), 201);
    }

}
