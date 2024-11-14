@extends('layout.club')

@section('clubs')
<div class="container mx-auto">
    <p class="text-3xl font-normal text-center pt-8 text-palette ">All Events</p>
   
    <div class="event-list mt-5 pb-10">
        @foreach ($events as $event)
            <div class="container lg:w-4/5 mx-auto flex flex-col event-container event-item">
                <div class="flex flex-col md:flex-row w-full bg-white rounded-lg shadow-xl mt-4 mx-2">
                    <!-- Event Image -->
                    <div class="h-64 w-full min-w-1/3 md:w-1/2" onclick="openModal('{{ $event->id }}')">
                        @php
                            $imageUrl = asset('assets/' . $event->photo);
                        @endphp
                        <img class="inset-0 h-full min-w-full object-cover object-center cursor-pointer" src="{{ $imageUrl }}"
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
                            @php
                                $isCollaborator = !is_null($collaborators) && in_array(Auth::user()->name, $collaborators);
                                $isPendingCollaborator = $event->users()->where('users.id', Auth::user()->id)->wherePivot('status', 'pending')->exists();
                            @endphp
                            @if(Auth::user()->id !== $event->user_id && !$isCollaborator && !$isPendingCollaborator)
                                <form method="POST" action="{{ route('events.collaborate', $event->id) }}">
                                    @csrf
                                    <button type="submit" class="text-white bg-purple-500 hover:shadow-xl hover:bg-purple-600 rounded px-3 py-1.5 shadow-sm text-sm uppercase">Apply as collaborator</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div id="modal-{{ $event->id }}" class="fixed inset-0 hidden items-center justify-center z-50 w-screen bg-gray-900 bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 relative">
                    <button onclick="closeModal('{{ $event->id }}')" class="absolute top-0 right-0 mt-2 mr-2 text-gray-700 hover:text-gray-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                    <img src="{{ asset('assets/' . $event->photo) }}" alt="{{ $event->title }}" class="h-48 object-cover rounded-md mb-4 mx-auto">
                    <h3 class="text-xl font-bold mb-2 text-center">{{ $event->title }}</h3>
                    <p class="text-gray-600 mb-2 text-center">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
                    <p class="text-gray-700 mb-4">{{ $event->description }}</p>
                    <p class="text-gray-700 mb-4">Budget: Rs. {{ $event->budget }}</p>
                    @if ($event->report_description)<p class="text-gray-700 mb-4">Report: {{ $event->report_description }}</p>
                    @endif
                    @if ($event->report_images)
                        <div class="flex flex-wrap justify-center">
                            @foreach (json_decode($event->report_images) as $reportImage)
                                <img src="{{ asset('assets/' . $reportImage) }}" alt="Report Image" class="h-24 object-cover rounded-md m-2">
                            @endforeach
                        </div>
                    @endif
                    <p class="text-gray-700 mb-4">Collaborators: {{$event->user->name}}@if ($collaborators) | {{ implode(' | ', $collaborators) }}@endif</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

<script>
    function openModal(eventId) {
        document.getElementById(`modal-${eventId}`).classList.remove('hidden');
        document.getElementById(`modal-${eventId}`).classList.add('flex');
    }

    function closeModal(eventId) {
        document.getElementById(`modal-${eventId}`).classList.remove('flex');
        document.getElementById(`modal-${eventId}`).classList.add('hidden');
    }
</script>
