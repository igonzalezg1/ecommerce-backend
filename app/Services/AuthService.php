<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthService.
 */
class AuthService
{

    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function login(array $data): array
    {
        if (!Auth::attempt($data)) {
            throw new Exception('Credenciales inválidas');
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;
        return ['user' => $user, 'token' => $token];
    }

    public function logout(User$user): void
    {
        $user->currentAccessToken()->delete();
    }

    public function register(array $data): string
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);
        return $user->createToken('api-token')->plainTextToken;
    }
}
