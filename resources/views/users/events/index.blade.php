@extends('layout.user')

@section('users')
    <div class="container_section bg-gray-100">
        <div class="h-auto">
            <h1 class="text-5xl font-normal text-center py-8 text-palette ">Events</h1>

            <!-- Filter Select -->
            <div class="flex justify-end items-center w-5/6 gap-4 space-x-4 mb-4">
                <label for="filterSelect" class="mr-2">Filter:</label>
                <select id="filterSelect" class="outline-none p-2">
                    <option value="all">All Events</option>
                    <option value="upcoming">Upcoming Events</option>
                    <option value="past">Past Events</option>
                </select>
            </div>

            <!-- Event List -->
            <div class="event-list pb-10">
                @foreach ($events as $event)
                    <div class="container lg:w-4/5 mx-auto flex flex-col event-container event-item">
                        <div class="flex flex-col md:flex-row w-full bg-white rounded-lg shadow-xl mt-4 mx-2">
                            <!-- Event Image -->
                            <div class="h-64 w-full min-w-1/3 md:w-1/2">
                                @php
                                    $imageUrl = asset('assets/' . $event->photo);
                                @endphp
                                <img class="inset-0 h-full min-w-full object-cover object-center" src="{{ $imageUrl }}"
                                    alt="Event Image" />
                            </div>
                            <!-- Event Details -->
                            <div class="w-full py-4 px-6 text-gray-800 flex flex-col justify-between font-roboto">
                                <h3 class="font-medium text-2xl leading-tight">{{ $event->title }}</h3>
                                <p class="text-sm text-gray-700 mt-2">
                                    By: {{ $event->user->name }}
                                    @php
                                        $collaborators = json_decode($event->collaborators, true);
                                    @endphp
                                    @if (!empty($collaborators))
                                        |
                                        @foreach ($collaborators as $collaborator)
                                            {{ $collaborator }}
                                            @if (!$loop->last)
                                                |
                                            @endif
                                        @endforeach
                                    @endif
                                    &bull; Date: {{ $event->date }}
                                </p>
                                <div class="mt-2 line-clamp-3 break-words">{{ strip_tags($event->description) }}</div>
                                <div class="flex justify-end">
                                    <button type="button"
                                        class="text-white bg-purple-600 hover:shadow-xl rounded px-3 py-1.5 shadow-sm text-sm uppercase">
                                        <a href="{{ route('event.showuser', [$event->id]) }}">Read More</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const eventItems = document.querySelectorAll('.event-item');
            const filterSelect = document.getElementById('filterSelect');

            // Show all events by default
            showEvents('all');

            // Event listener for filter select change
            filterSelect.addEventListener('change', function () {
                const selectedOption = this.value;
                showEvents(selectedOption);
            });

            function showEvents(type) {
                const currentDate = new Date().toISOString().slice(0, 10);
                
                eventItems.forEach(item => {
                    const date = item.querySelector('p').textContent.match(/Date: (\d{4}-\d{2}-\d{2})/)[1];

                    if (type === 'all' || (type === 'upcoming' && date >= currentDate) || (type === 'past' && date < currentDate)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }
        });
    </script>
@endsection
