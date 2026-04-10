<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use App\Http\Resources\TicketStatisticsResource;
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
            'message' => 'Ticket created successfully',
            'data' => new TicketResource($ticket)
        ]);
    }

    public function statistics()
    {
        return TicketStatisticsResource::make(
            $this->ticketService->getStatistics()
        );
    }
}
