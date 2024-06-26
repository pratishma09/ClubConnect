@extends('layout.club')

@section('clubs')
<div>
    <div class="relative flex items-center justify-center h-screen">
        <div id="carousel" class="carousel flex overflow-x-auto scroll-smooth snap-x snap-mandatory space-x-4">
            @foreach($events as $event)
            <div class="min-w-full snap-start flex-shrink-0 p-4">
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <img src="{{ asset('assets/' . $event->photo) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover rounded-md mb-4">
                    <h3 class="text-lg font-bold mb-2">{{ $event->title }}</h3>
                    <p class="text-gray-700 mb-2">{{ $event->description }}</p>
                    <p class="text-gray-600 mb-2">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
                    <p class="text-gray-600 mb-2">Budget: ${{ $event->budget }}</p>
{{-- {{dd($event->user_id)}} --}}
                    @if(Auth::user()->id !== $event->user_id )
                        <form method="POST" action="{{ route('events.collaborate', $event->id) }}">
                            @csrf
                            <button type="submit" class="mt-4 bg-blue-500 px-4 py-2 rounded">Add as collaborator</button>
                        </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <button id="prev" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-4 py-2 rounded-r-md">Prev</button>
        <button id="next" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-4 py-2 rounded-l-md">Next</button>
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
</script>
