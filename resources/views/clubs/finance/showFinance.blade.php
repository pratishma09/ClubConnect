@extends('layout.club')

@section('clubs')
<div class="relative overflow-x-auto shadow-md">
    <h1 class="text-xl font-semibold text-gray-900 m-5 text-center">Your Finance Details</h1>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                 Event Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                {{-- <th scope="col" class="px-6 py-3">
                    Budget
                </th> --}}
                <th scope="col" class="px-6 py-3">
                    Amount Spent
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eventsWithAmountSpent as $event)
            <tr class="bg-white dark:border-gray-700 cursor-pointer" onclick="window.location='{{ route('events.update_budget', $event->id) }}'">
                
                <td class="px-6 py-4">
                    {{$event->title}}
                </td>
                <td class="px-6 py-4">
                    {{$event->date}}
                </td>
                {{-- <td class="px-6 py-4">
                    {{$event->budget}}
                </td> --}}
                <td class="px-6 py-4">
                    {{$event->amount_spent}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection