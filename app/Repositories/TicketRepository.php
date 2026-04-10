<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Ticket;
use App\Repositories\Interfaces\TicketRepositoryInterface;

class TicketRepository implements TicketRepositoryInterface
{
    public function store(array $data): Ticket
    {

        $customer = Customer::firstOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['name'],
                'phone' => $data['phone'] ?? null,
            ]
        );

        return Ticket::create([
            'customer_id' => $customer->id,
            'subject' => $data['subject'],
            'description' => $data['description'],
            'status' => 'new',
        ]);

    }
}
