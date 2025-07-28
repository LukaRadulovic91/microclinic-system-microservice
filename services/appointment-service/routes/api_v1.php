<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AppointmentController;

Route::prefix('api/v1')->group(function () {
    Route::post('appointments', [AppointmentController::class, 'schedule']);
});
