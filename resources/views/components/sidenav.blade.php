<div class="mt-10">
    <div class="flex gap-5 mb-10">
        <a href="/" class="flex items-center">
            <img class="h-32 w-32 ml-5 object-contain" src="{{ asset('assets/logo.png') }}" alt="" />
        </a>
    </div>
    <div class=" text-lg">
        <ul class="flex flex-col px-10 gap-2">
            <li class="mb-6">
                <a href="{{ route('clubs.index') }}">
                    <span class="flex items-center gap-3 p-2 text-white hover:bg-[#ce87e8] text-xl">
                        <i class="fas fa-user"></i>
                        <p>Clubs</p>
                    </span>
                </a>
            </li>

            <li class="mb-6">
                <a href="{{ route('admin.show_finance') }}">
                    <span class="flex items-center gap-3  text-white hover:bg-[#ce87e8] p-2 text-xl">
                        <i class="fas fa-coins"></i>
                        <p>Finance</p>
                    </span>
                </a>
            </li>
            <li class="mb-6">
                <a href="{{ route('events.adminIndex') }}">
                    <span class="flex items-center gap-3  text-white hover:bg-[#ce87e8] p-2 text-xl">
                        <i class="fas fa-calendar-check"></i>
                        <p>Events</p>
                    </span>
                </a>
            </li>
            <li class="mb-6">
                <a href="{{ route('contact.show') }}">
                    <span class="flex items-center gap-3  text-white hover:bg-[#ce87e8] p-2 text-xl">
                        <i class="fas fa-envelope-open"></i>
                        <p>Contact</p>
                    </span>
                </a>
            </li>
            <li class="mb-6">
                <a href="{{ route('admin.changePassword') }}">
                    <span class="flex items-center gap-3  text-white hover:bg-[#ce87e8] p-2 text-xl">
                        <i class="fas fa-key"></i>
                        <p>Change Password</p>
                    </span>
                </a>
            </li>
        </ul>
    </div>
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
