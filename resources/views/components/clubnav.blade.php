<div class="text-lg text-white h-screen flex flex-col pb-3 justify-between">
    <div class="flex flex-col gap-5 pt-10 px-10">
        <div class="flex mx-1">
            <a href="/" class="flex items-center justify-center">
                <img class="h-32 w-32 ml-5 object-contain" src="{{ asset('assets/logo.png') }}" alt="" />
              </a>
        </div>
       
        <a href="{{route('events.all')}}" class="flex items-center gap-3 hover:bg-[#ce87e8] p-2 rounded">
            <i class="fas fa-calendar-alt"></i> All
        </a>
        <a href="{{route('events.index')}}" class="flex items-center gap-3 hover:bg-[#ce87e8] p-2 rounded">
            <i class="fas fa-calendar-check"></i> Events
        </a>
        <a href="{{route('events.showFinance')}}" class="flex items-center gap-3 hover:bg-[#ce87e8] p-2 rounded">
            <i class="fas fa-coins"></i> Finance
        </a>
        <a href="{{route('clubparticipation')}}" class="flex items-center gap-3 hover:bg-[#ce87e8] p-2 rounded">
            <i class="fas fa-person"></i> Participants
        </a>
        <a href="{{ route('events.show') }}" class="flex items-center gap-3 hover:bg-[#ce87e8] p-2 rounded">
            <i class="fas fa-bell"></i> Notifications
        </a>
        <a href="{{route('changePassword')}}" class="flex items-center gap-3 hover:bg-[#ce87e8] p-2 rounded">
            <i class="fas fa-key"></i> Change Password
        </a>
    </div>
    <div class="mb-4  text-white hover:bg-[#ce87e8] p-2">
        <div class="ml-16 p-2">
            <form method="POST" action="{{ route('custom.logout') }}">
                @csrf
                <button id="logoutForm" type="submit" onclick="submitLogoutForm()"
                    class="items-center flex gap-2 text-lg rounded outline-none">
                    <i class="fas fa-arrow-right-from-bracket text-xl"></i>
                    <p class="">Logout</p>
                </button>
            </form>
        </div>
    </div>    
</div>
