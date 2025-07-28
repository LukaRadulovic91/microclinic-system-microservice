<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_schedule_appointment_success()
    {
        $user = User::factory()->create();

        $payload = [
            'user_id' => $user->id,
            'scheduled_for' => now()->addDay()->toDateTimeString(),
            'notes' => 'Test appointment',
        ];

        $response = $this->postJson('/api/v1/appointments', $payload);

        $response->assertStatus(201)
            ->assertJsonStructure(['message', 'data' => ['id', 'user_id', 'scheduled_for', 'notes']]);

        $this->assertDatabaseHas('appointments', [
            'user_id' => $user->id,
            'notes' => 'Test appointment',
        ]);
    }

    public function test_schedule_appointment_validation_fails()
    {
        $response = $this->postJson('/api/v1/appointments', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['user_id', 'scheduled_for']);
    }
}
