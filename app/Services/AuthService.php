<?php

namespace App\Services;

use App\Repositories\Interfaces\AuthRepositoryInterface;

class AuthService
{
    public function __construct(
        protected AuthRepositoryInterface $authRepository
    ) {}

    public function login(array $data): bool
    {
        return $this->authRepository->login($data);
    }

    public function logout(): void
    {
        $this->authRepository->logout();
    }
}
