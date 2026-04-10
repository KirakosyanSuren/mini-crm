<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Ticket;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TicketRepository implements TicketRepositoryInterface
{

    public function getAll(array $filters): LengthAwarePaginator
    {
        $query = Ticket::query()->with('customer');

        $query->whereHas('customer', function ($q) use ($filters) {

            if (!empty($filters['name'])) {
                $q->where('name', 'like', '%' . $filters['name'] . '%');
            }

            if (!empty($filters['email'])) {
                $q->where('email', 'like', '%' . $filters['email'] . '%');
            }

            if (!empty($filters['phone'])) {
                $q->where('phone', 'like', '%' . $filters['phone'] . '%');
            }
        });

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['date'])) {
            $query->whereDate('created_at', $filters['date']);
        }

        return $query->latest()->paginate(10);
    }

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

    public function getById(int $id): Ticket
    {
        return Ticket::find($id);
    }

    public function updateStatus(Ticket $ticket, string $status): Ticket
    {
        $ticket->update([
            'status' => $status
        ]);

        return $ticket;
    }

    public function getStatistics(Carbon $date): int
    {
        return Ticket::query()
            ->statisticPeriod($date)
            ->count();
    }
}
