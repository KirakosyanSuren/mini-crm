<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tickets</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/adminTicketIndex.css') }}">
</head>
<body>

<div class="container">
    <h1>Tickets</h1>

    <div class="card">

        <!-- FILTERS -->
        <form method="GET" class="filters" id="filter-form">
            <input type="text" name="name" placeholder="Name" value="{{ request('name') }}">
            <input type="text" name="email" placeholder="Email" value="{{ request('email') }}">
            <input type="text" name="phone" placeholder="Phone" value="{{ request('phone') }}">
            <input type="date" name="date" value="{{ request('date') }}">

            <select name="status">
                <option value="">All Status</option>
                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                <option value="in_process" {{ request('status') === 'in_process' ? 'selected' : '' }}>In process</option>
                <option value="processed" {{ request('status') === 'processed' ? 'selected' : '' }}>Processed</option>
            </select>

            <button type="submit" class="btn filter-btn">Filter</button>

            <a class="btn filter-btn" href="{{ route('admin.ticket.index') }}">Reset</a>
        </form>

        <!-- TABLE -->
        @if($tickets->count() > 0)
            <table>
                <thead>
                <tr>
                    <th>N</th>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Customer Phone</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>

                @foreach($tickets as $key => $ticket)
                    <tr>
                        <td>#{{ $tickets->firstItem() + $key }}</td>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->customer->name }}</td>
                        <td>{{ $ticket->customer->email }}</td>
                        <td>{{ $ticket->customer->phone }}</td>
                        <td>{{ $ticket->subject }}</td>
                        <td>{{ $ticket->description }}</td>
                        <td>{{ $ticket->status }}</td>
                        <td class="date-td">{{ date('d-m-Y', strtotime($ticket->created_at)) }}</td>

                        <td>
                            <a href="{{ route('admin.ticket.show', $ticket->id) }}" class="btn">View</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="pagination-wrapper">
                {{ $tickets->appends(request()->query())->links() }}
            </div>
        @else
            <div class="empty">No tickets found</div>
        @endif

    </div>
</div>

{{--<script src="{{ asset('assets/scripts/adminTicketIndex.js') }}"></script>--}}

</body>
</html>
