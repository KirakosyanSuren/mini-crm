<?php

namespace App\Services;


use App\Models\Ticket;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;

class TicketService
{

    public function __construct(
        protected TicketRepositoryInterface $ticketRepository
    ) {}

    public function getAll(array $filters): LengthAwarePaginator
    {
        return $this->ticketRepository->getAll($filters);
    }

    public function store(
        array  $data,
        ?array $files = null
    ): Ticket
    {
        $exists = Ticket::query()
            ->today()
            ->byCustomer($data['email'], $data['phone'] ?? null)
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'contact' => 'You have already submitted your feedback today.'
            ]);
        }

        $ticket = $this->ticketRepository->store($data);

        if (!empty($files)) {
            foreach ($files as $file) {
                $ticket
                    ->addMedia($file)
                    ->toMediaCollection('tickets');
            }
        }

        return $ticket;
    }

    public function getById(int $id)
    {
        return $this->ticketRepository->getById($id);
    }

    public function updateStatus(Ticket $ticket, string $status): Ticket
    {
        return $this->ticketRepository->updateStatus($ticket, $status);
    }

}
