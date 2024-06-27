@extends('layout.club')

@section('clubs')
<div class="container mx-auto">
    <p class="text-3xl text-center pt-20">All Events</p>
    <div class="relative flex items-center justify-center mx-10">
        <button id="prev" class="transform -translate-y-1/2 bg-purple-800 text-white px-4 py-2 rounded-r-md hover:bg-purple-900"><i class="fa-solid fa-arrow-left"></i><p class="hidden">Prev</p></button>
        <div id="carousel" class="carousel flex overflow-hidden scroll-smooth snap-x snap-mandatory">

            @foreach($events as $event)
                <div class="snap-start w-80 overflow-auto flex-shrink-0">
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center flex flex-col justify-between h-96 cursor-pointer" onclick="openModal('{{ $event->id }}')">
                        <img src="{{ asset('assets/' . $event->photo) }}" alt="{{ $event->title }}" class="h-48 object-cover rounded-md mb-4">
                        <div class="flex-grow">
                            <h3 class="text-xl font-bold mb-2">{{ $event->title }}</h3>
                            <p class="text-gray-600 mb-2">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
                        </div>
                        @php
                            $collaborators = json_decode($event->collaborators, true);
                            $isCollaborator = !is_null($collaborators) && in_array(Auth::user()->name, $collaborators);
                            $isPendingCollaborator = $event->users()->where('users.id', Auth::user()->id)->wherePivot('status', 'pending')->exists();

                        @endphp
                        @if(Auth::user()->id !== $event->user_id && !$isCollaborator && !$isPendingCollaborator)
                            <form method="POST" action="{{ route('events.collaborate', $event->id) }}">
                                @csrf
                                <button type="submit" class="mt-4 bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">Add as collaborator</button>
                            </form>
                        @endif
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
       <button id="next" class="transform -translate-y-1/2 bg-purple-800 text-white px-4 py-2 rounded-r-md hover:bg-purple-900"><i class="fa-solid fa-arrow-right"></i><p class="hidden">Next</p></button>
        
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carousel = document.getElementById('carousel');
        const next = document.getElementById('next');
        const prev = document.getElementById('prev');

        next.addEventListener('click', () => {
            carousel.scrollBy({ left: carousel.clientWidth, behavior: 'smooth' });
        });

        prev.addEventListener('click', () => {
            carousel.scrollBy({ left: -carousel.clientWidth, behavior: 'smooth' });
        });
    });

    function openModal(eventId) {
        document.getElementById(`modal-${eventId}`).classList.remove('hidden');
        document.getElementById(`modal-${eventId}`).classList.add('flex');
    }

    function closeModal(eventId) {
        document.getElementById(`modal-${eventId}`).classList.remove('flex');
        document.getElementById(`modal-${eventId}`).classList.add('hidden');
    }
</script>
