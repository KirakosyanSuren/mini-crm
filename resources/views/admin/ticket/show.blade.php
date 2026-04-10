<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Ticket</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/adminTicketIndex.css') }}">
</head>
<body>

<div class="container">
    <h1>Ticket #{{ $ticket->id }}</h1>

    <div class="card">

        <div style="margin-bottom: 20px;">
            <a href="{{ route('admin.ticket.index') }}" class="btn">← Back</a>
        </div>

        <h3>Customer Info</h3>
        <table>
            <tr>
                <th style="width: 200px;">Name</th>
                <td>{{ $ticket->customer->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $ticket->customer->email }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $ticket->customer->phone }}</td>
            </tr>
        </table>

        <br>

        <h3>Ticket Info</h3>
        <table>
            <tr>
                <th style="width: 200px;">Subject</th>
                <td>{{ $ticket->subject }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{{ $ticket->description }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <form method="POST" action="{{ route('admin.ticket.updateStatus', $ticket->id) }}" style="display:flex; gap:10px; align-items:center;">
                        @csrf
                        @method('PATCH')

                        <select name="status" class="status">
                            <option value="new" {{ $ticket->status == 'new' ? 'selected' : '' }}>New</option>
                            <option value="in_process" {{ $ticket->status == 'in_process' ? 'selected' : '' }}>In process</option>
                            <option value="processed" {{ $ticket->status == 'processed' ? 'selected' : '' }}>Processed</option>
                        </select>

                        <button type="submit" class="btn">Update</button>
                    </form>
                </td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $ticket->created_at }}</td>
            </tr>
        </table>

        <h3>Files</h3>

        @if($ticket->getMedia('tickets')->count())
            <ul>
                @foreach($ticket->getMedia('tickets') as $media)
                    <li>
                        <a href="{{ $media->getUrl() }}" target="_blank">
                            {{ $media->file_name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No files uploaded</p>
        @endif
    </div>
</div>

</body>
</html>
