@extends('layout.user')

@section('users')
<div class="flex flex-col bg-white lg:flex-row container mx-auto py-8 rounded">
    <div class="lg:w-4/5">
        <h1 class="text-5xl mb-4 text-blue pl-6">{{ $event->title }}</h1>

        <div class="p-6 rounded">
            <div class="w-auto flex justify-center items-center">
                @php
                    $imageUrl = asset('assets/' . $event->photo);
                    
                @endphp
                <img src="{{ $imageUrl }}" alt="{{ $event->title }}" class="mb-4 rounded-lg object-cover object-center h-96 w-full inset-0">
            </div>
            <div class="flex flex-row justify-between">
                <p class="text-gray-700 mb-2 font-light text-md">-{{ $event->user->name }}@php
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
                @endif</p>
                <p class="text-gray-700 mb-2 font-light text-md">Date: {{ $event->date }}</p>
            </div>
            <div class="text-gray-700 mb-4 break-words">{!! $event->description !!}</div>
            <div class="flex justify-end">
                <a href="{{ route('userevent') }}" class="text-blue-500 hover:underline text-blue">Back to Events</a>
            </div>
        </div>
    </div>
    <div class="container lg:w-2/6 sm:w-1/2 pr-10">
        <h1 class="text-blue pl-6 pt-5 text-2xl">Recent Events</h1>
        @foreach($events as $recentEvent)
            <div class="pl-6">
                
                <a href="{{ route('event.showuser', $recentEvent->id) }}">
                    <div class="w-auto">
                        @php
                            $recentEventImageUrl = asset('assets/' . $recentEvent->photo);
                            
                        @endphp
                        <img src="{{ $recentEventImageUrl }}" alt="{{ $recentEvent->title }}" class="mt-2 rounded-lg h-48 w-full object-cover object-center inset-0">
                    </div>
                    <p class="text-blue pt-2 pb-4">{{ $recentEvent->title }}</p>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection