<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\ValidatorService;
use Framework\Response;

readonly class AuthController
{
    public function __construct(
        private ValidatorService $validatorService,
        private AuthService $authService
    ) {
    }

    public function register(): void
    {
        $data = json_decode(file_get_contents('php://input'), true) ?? [];

        $this->validatorService->validate($data, [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'profession' => ['required']
        ]);

        $user = $this->authService->register(
            $data['name'],
            $data['email'],
            $data['password'],
            $data['profession']
        );

        Response::json([
            'message' => 'User registered successfully',
            'user' => [
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail()
            ]
        ]);
    }

    public function login(): void
    {
        $data = json_decode(file_get_contents('php://input'), true) ?? [];

        $this->validatorService->validate($data, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $result = $this->authService->login($data['email'], $data['password']);

        Response::json([
            'message' => 'Login successful',
            'user' => [
                'id' => $result['user']->getId(),
                'name' => $result['user']->getName(),
                'email' => $result['user']->getEmail()
            ],
            'token' => $result['token']
        ]);
    }
}