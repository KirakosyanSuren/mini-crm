<?php

namespace App\Repositories\Interfaces;

use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TicketRepositoryInterface
{
    public function getAll(array $filters): LengthAwarePaginator;
    public function store(array $data): Ticket;
    public function getById(int $id): Ticket;
    public function updateStatus(Ticket $ticket, string $status): Ticket;
}
