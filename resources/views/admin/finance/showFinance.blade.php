@extends('layout.admin')

@section('content')

<div class="relative overflow-x-auto shadow-md">
    <h1 class="text-xl font-semibold text-gray-900 m-5">Finance Details - Total Budget Spent by Event</h1>
{{-- 
    <div class="m-5">
        {!! $chart->container() !!}
    </div> --}}

    <table class="w-full text-sm text-left mt-10 rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Event Name</th>
                <th scope="col" class="px-6 py-3">Total Amount Spent</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sortedEvents as $event)
            <tr class="bg-white dark:border-gray-700 ">
                <td class="px-6 py-4">{{ $event['event'] }}</td>
                <td class="px-6 py-4">{{ $event['total_spent'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{!! $chart->script() !!}

@endsection
