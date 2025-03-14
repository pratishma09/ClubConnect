@extends('layout.admin')

@section('content')
<div class="relative overflow-x-auto shadow-md">
    <div class="text-palette rounded m-5 py-1 px-2">
        <h1 class="text-lg font-bold">Tickets for {{ $event->title }}</h1>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Buyer Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Ticket Count
                </th>
                <th scope="col" class="px-6 py-3">
                    Total Amount
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
            <tr class="bg-white dark:border-gray-700">
                <td class="px-6 py-4">
                    {{ $ticket->buyer_name }}
                </td>
                <td class="px-6 py-4">
                    {{ $ticket->ticket_count }}
                </td>
                <td class="px-6 py-4">
                    {{ $ticket->ticket_count * $event->price }} <!-- Calculate total amount -->
                </td>
            </tr>
            @endforeach
            <!-- Display total tickets and total amount -->
            <tr class="bg-gray-100">
                <td class="px-6 py-4 font-bold">Total</td>
                <td class="px-6 py-4 font-bold">
                    {{ $tickets->sum('ticket_count') }}
                </td>
                <td class="px-6 py-4 font-bold">
                    {{ $tickets->sum(function($ticket) use ($event) {
                        return $ticket->ticket_count * $event->price;
                    }) }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
