@extends('layout.club')

@section('clubs')
    <div class="container mx-auto p-4">
        @php
            $hasPendingRequests = false;
        @endphp

        @if ($events->isEmpty())
            <p class="text-gray-700 text-center">No events posted.</p>
        @else
            <div class="bg-white shadow-md rounded-lg p-6">
                @foreach ($events as $event)
                    @foreach ($event->users as $user)
                        @if ($user->pivot->status === 'pending')
                            @php
                                $hasPendingRequests = true;
                            @endphp

                            <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mb-4">
                                <div class="flex justify-between items-center">
                                    <p>
                                        <strong>{{ $user->name }}</strong> has requested to collaborate on <strong>{{ $event->title }}</strong>.
                                    </p>
                                    <div class="flex space-x-2">
                                        <form action="{{ route('events.acceptCollaboration', ['eventId' => $event->id, 'userId' => $user->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Accept</button>
                                        </form>
                                        <form action="{{ route('events.rejectCollaboration', ['eventId' => $event->id, 'userId' => $user->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Reject</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach

                @if (!$hasPendingRequests)
                    <p class="text-gray-700 text-center">No pending collaboration requests.</p>
                @endif
            </div>
        @endif
    </div>
@endsection
