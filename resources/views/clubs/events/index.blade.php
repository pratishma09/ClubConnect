@extends('layout.club')
@section('clubs')


<div class="relative overflow-x-auto shadow-md">
    <button class="text-white bg-palette rounded m-5 py-1 px-2"><a href="{{ route('events.create') }}">Create Event</a></button>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Photo
                </th>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Budget
                </th>
                {{-- <th scope="col" class="px-6 py-3">
                    Report
                </th> --}}
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr class="bg-white dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <img class="w-20 h-10" src="{{ asset('assets/' . $event->photo) }}" alt="Event Not Held Yet">
                </th>
                <td class="px-6 py-4">
                    {{$event->title}}
                </td>
                <td class="px-6 py-4">
                    {{$event->description}}
                </td>
                <td class="px-6 py-4">
                    {{$event->date}}
                </td>
                <td class="px-6 py-4">
                    {{$event->budget}}
                </td>
                {{-- <td class="px-6 py-4">
                    {{$event->report_description}}
                </td> --}}
                <td class="px-6 py-4 flex gap-2">
                    <a href="{{route('events.edit', $event->id)}}" class="font-medium text-white dark:text-white py-1 px-2 rounded bg-palette">Edit</a>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="font-medium text-white dark:text-white py-1 px-2 rounded bg-palette">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
@endsection
