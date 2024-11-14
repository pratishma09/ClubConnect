<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .ticket {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .ticket h1 {
            margin-top: 0;
            color: #333;
        }
        .ticket img {
            max-width: 100%;
        }
        .ticket-details {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <h1>{{ $event->title }}</h1>
        <p>Date: {{ $event->date }}</p>
        <p>Location: {{ $event->location }}</p>
        <p>Organized by: {{ $event->user->name }}@if($event->collaborator) || {{ $event->collaborator }} @endif</p>

        <div class="ticket-details">
            <p><strong>Ticket ID:</strong> {{ $ticket->id }}</p>
            <p><strong>Ticket Count:</strong> {{ $ticket->ticket_count }}</p>
            <p><strong>Total Price:</strong> Rs.{{ $ticket->ticket_count * $event->price }}</p>
        </div>
    </div>
</body>
</html>
