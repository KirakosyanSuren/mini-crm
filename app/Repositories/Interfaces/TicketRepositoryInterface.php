<?php

namespace App\Repositories\Interfaces;

use App\Models\Ticket;

interface TicketRepositoryInterface
{
    public function store(array $data): Ticket;
}
