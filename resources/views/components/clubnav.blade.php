<div class="pt-10 pb-10 flex flex-col gap-5 bg-purple-100 sticky justify-center px-10">
    <a href="{{route('events.all')}}">All</a>
    <a href="{{route('events.index')}}">Events</a>
    <a href="{{route('events.all')}}">Finance</a>
    {{-- <a href="{{route('finance.club')}}">Finance</a> --}}
    {{-- <a href="{{route('events.filter')}}">My Events</a> --}}
    <a href="{{route('events.index')}}">My Events</a>
    <a href="{{route('changePassword')}}">Change Password</a>
    <div class="mb-4">
        <form method="POST" action="{{ route('custom.logout') }}">
            @csrf
            <button id="logoutForm" type="submit" onclick="submitLogoutForm()">
                Logout
                </span>
            </button>
        </form>
    </div>
</div>