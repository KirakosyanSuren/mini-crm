<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function __construct(
        protected TicketService $ticketService
    ) {}

    public function index(Request $request)
    {
        $tickets = $this->ticketService->getAll($request->all());

        return view('admin.ticket.index', compact('tickets'));
    }

    public function create()
    {
        return view('widget');
    }

    public function show($id)
    {
        $ticket = $this->ticketService->getById($id);

        return view('admin.ticket.show', compact('ticket'));
    }

    public function updateStatus($id, Request $request)
    {
        $ticket = $this->ticketService->getById($id);

        $this->ticketService->updateStatus($ticket, $request->status);

        return redirect()->back()->with('success', 'Status updated successfully');
    }
}
