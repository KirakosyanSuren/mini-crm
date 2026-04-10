<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Services\TicketService;

class TicketController extends Controller
{
    public function __construct(
        protected TicketService $ticketService
    ) { }

    public function store(TicketRequest $request)
    {
        $ticket = $this->ticketService->store(
            $request->validated(),
            $request->file('files')
        );

        return response()->json([
            'message' => 'Ticket created successfully'
        ]);

    }
}
