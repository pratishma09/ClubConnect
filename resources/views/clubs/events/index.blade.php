@extends('layout.club')
@section('clubs')
    <div class="relative overflow-x-auto shadow-md">
        <button class="text-white bg-palette rounded m-5 py-1 px-2"><a href="{{ route('events.create') }}"
                class="text-white">Create
                Event</a></button>
        <div class="flex justify-center">
            <div id="calendar" class="w-1/2"></div>
        </div>
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
                    <th scope="col" class="px-6 py-3">
                        Ticket
                    </th>
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
                            {{ $event->title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $event->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $event->date }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $event->budget }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($event->price)
                                <a href="{{ route('events.ticket', $event->id) }}" class="hover:text-palette">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('events.edit', $event->id) }}"
                                class="font-medium text-white dark:text-white py-1 px-2 rounded bg-palette">Edit</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="font-medium text-white dark:text-white py-1 px-2 rounded bg-palette">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {

            var SITEURL = "{{ url('/') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable: true,
                events: SITEURL + "/fullcalender",
                displayEventTime: false,
                editable: true,
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                        $.ajax({
                            url: SITEURL + "/fullcalenderAjax",
                            data: {
                                title: title,
                                start: start,
                                end: end,
                                type: 'add'
                            },
                            type: "POST",
                            success: function(data) {
                                displayMessage("Event Created Successfully");

                                calendar.fullCalendar('renderEvent', {
                                    id: data.id,
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: allDay
                                }, true);

                                calendar.fullCalendar('unselect');
                            }
                        });
                    }
                },
                eventDrop: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                    $.ajax({
                        url: SITEURL + '/fullcalenderAjax',
                        data: {
                            title: event.title,
                            start: start,
                            end: end,
                            id: event.id,
                            type: 'update'
                        },
                        type: "POST",
                        success: function(response) {
                            displayMessage("Event Updated Successfully");
                        }
                    });
                },


            });

        });

        function displayMessage(message) {
            toastr.success(message, 'Event');
        }
    </script>
@endsection
