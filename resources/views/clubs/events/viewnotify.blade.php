@extends('layout.club')

@section('clubs')
    <div class="container">
        @php
            $hasPendingRequests = false;
        @endphp

        @foreach ($event as $events)
            @foreach ($events->users as $user)
                @if ($user->pivot->status === 'pending')
                    @php
                        $hasPendingRequests = true;
                    @endphp

                    <div>
                        <strong>{{ $user->name }}</strong> has requested to collaborate.
                        <form action="{{ route('events.acceptCollaboration', ['eventId' => $events->id, 'userId' => $user->id]) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Accept</button>
                        </form>
                        <form action="{{ route('events.rejectCollaboration', ['eventId' => $events->id, 'userId' => $user->id]) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                        </form>
                    </div>
                @endif
            @endforeach
        @endforeach

        @if (!$hasPendingRequests)
            <p>No pending collaboration requests.</p>
        @endif
    </div>
@endsection
