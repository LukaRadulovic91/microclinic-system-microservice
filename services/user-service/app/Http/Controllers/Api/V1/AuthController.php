<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $userData = $request->validated();

        $user = $this->userService->register($userData);

        return response()->json([
            'message' => 'User registered successfully',
            'data' => $user,
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        $token = $this->userService->login($credentials);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
