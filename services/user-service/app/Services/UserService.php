<?php

namespace App\Services;

use App\DTOs\UserData;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\PersonalAccessTokenResult;

class UserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function register(array $data): UserData
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);

        return UserData::fromModel($user);
    }

    public function login(array $credentials): string
    {
        if (!Auth::attempt($credentials)) {
            abort(401, 'Invalid credentials');
        }

        /** @var User $user */
        $user = Auth::user();

        $tokenResult = $user->createToken('Personal Access Token');

        return $tokenResult->accessToken;
    }
}
