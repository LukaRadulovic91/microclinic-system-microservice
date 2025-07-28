<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Implement auth logic if needed
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'scheduled_for' => ['required', 'date', 'after:now'],
            'notes' => ['nullable', 'string', 'max:500'],
        ];
    }
}
