<div class="text-lg text-white h-screen flex flex-col pb-3 justify-between">
    <div class="flex flex-col gap-5 pt-10 px-10">
        <div class="flex gap-5 my-5 mb-8">
            <a href="/" class="flex items-center">
                <img class="h-8 object-contain" src="{{ asset('assets/logo.png') }}" alt="" />
              </a>
        </div>
       
        <a href="{{route('events.all')}}" class="flex items-center gap-3 hover:bg-purple-700 p-2 rounded">
            <i class="fas fa-calendar-alt"></i> All
        </a>
        <a href="{{route('events.index')}}" class="flex items-center gap-3 hover:bg-purple-700 p-2 rounded">
            <i class="fas fa-calendar-check"></i> Events
        </a>
        <a href="{{route('events.showFinance')}}" class="flex items-center gap-3 hover:bg-purple-700 p-2 rounded">
            <i class="fas fa-coins"></i> Finance
        </a>
        <a href="{{route('clubparticipation')}}" class="flex items-center gap-3 hover:bg-purple-700 p-2 rounded">
            <i class="fas fa-person"></i> Participants
        </a>
        <a href="{{ route('events.show') }}" class="flex items-center gap-3 hover:bg-purple-700 p-2 rounded">
            <i class="fas fa-bell"></i> Notifications
        </a>
        <a href="{{route('changePassword')}}" class="flex items-center gap-3 hover:bg-purple-700 p-2 rounded">
            <i class="fas fa-key"></i> Change Password
        </a>
    </div>
    <div class="ml-10 p-2">
        <form method="POST" action="{{ route('custom.logout') }}">
            @csrf
            <button id="logoutForm" type="submit" onclick="submitLogoutForm()" class="items-center flex gap-2 text-lg rounded">
                <i class="fas fa-arrow-right-from-bracket text-xl"></i><p class="">Logout</p>
            </button>
        </form>
    </div>
</div>
