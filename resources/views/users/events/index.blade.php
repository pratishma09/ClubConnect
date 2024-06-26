@extends('layout.user')

@section('users')
    <div class="container_section bg-gray-100">
        <div class="h-auto">
            <h1 class="text-5xl font-normal text-center py-8 text-blue">Events</h1>
            <div class="blog-list pb-10">
                @foreach ($events as $event)
                    <div class="container lg:w-4/5 mx-auto flex flex-col">
                        <div v-for="card in cards"
                            class="flex flex-col md:flex-row w-full bg-white rounded-lg shadow-xl mt-4 mx-2">
                            <div class="h-64 w-full min-w-1/3 md:w-1/2">
                                @php
                                    $imageUrl = asset('assets/' . $event->photo);
                                @endphp
                                <img class="inset-0 h-full min-w-full object-cover object-center" src="{{ $imageUrl }}"
                                    alt="blog image" />
                            </div>
                            <div class=" w-full py-4 px-6 text-gray-800 flex flex-col justify-between font-roboto">
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
                    </div><!--/ card-->
                @endforeach
            </div>
        </div>

    </div>
@endsection
