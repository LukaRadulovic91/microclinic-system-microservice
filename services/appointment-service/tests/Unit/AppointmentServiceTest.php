<?php

namespace Tests\Unit;

use App\Repositories\AppointmentRepository;
use App\Services\AppointmentService;
use App\Models\Appointment;
use PHPUnit\Framework\TestCase;
use Mockery;

class AppointmentServiceTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function test_schedule_returns_appointment_data()
    {
        $data = [
            'user_id' => 1,
            'scheduled_for' => '2025-08-01 10:00:00',
            'notes' => 'Test notes',
        ];

        $appointmentMock = Mockery::mock(Appointment::class);
        $appointmentMock->shouldReceive('toArray')->andReturn(array_merge(['id' => 1], $data));

        $repoMock = Mockery::mock(AppointmentRepository::class);
        $repoMock->shouldReceive('create')->with($data)->andReturn($appointmentMock);

        $service = new AppointmentService($repoMock);

        $result = $service->schedule($data);

        $this->assertEquals(1, $result->id);
        $this->assertEquals($data['user_id'], $result->user_id);
        $this->assertEquals($data['scheduled_for'], $result->scheduled_for);
        $this->assertEquals($data['notes'], $result->notes);
    }
}
