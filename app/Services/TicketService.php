<?php

namespace App\Services;


use App\Models\Ticket;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use Illuminate\Validation\ValidationException;

class TicketService
{

    public function __construct(
        protected TicketRepositoryInterface $ticketRepository
    ) {}

    public function store(
        array $data,
        ?array $files = null
    ): Ticket
    {
       $exists = Ticket::query()
        ->today()
        ->byCustomer($data['email'], $data['phone'] ?? null)
        ->exists();

//        if ($exists) {
//            throw ValidationException::withMessages([
//                'contact' => 'You have already submitted your feedback today.'
//            ]);
//        }

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

}
