<?php

namespace App\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AuthRepositoryInterface
{
    public function login(array $data): bool;
    public function logout(): void;
}
