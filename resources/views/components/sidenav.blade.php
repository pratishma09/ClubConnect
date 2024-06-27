<div class="mt-10 mb-10 mx-16">
  <div class="flex gap-5 my-5 mb-10 pb-10">
    <a href="/" class="flex items-center">
        <img class="h-8 object-contain" src="{{ asset('assets/logo.png') }}" alt="" />
      </a>
</div>
  <div class="mt-10 text-lg">
      <ul class="flex flex-col gap-5 mx-5 items-start">
          <li class="mb-6">
              <a href="{{ route('clubs.index') }}">
                  <span class="flex items-center gap-3 text-white text-xl">
                      <i class="fas fa-user"></i>
                      <p>Clubs</p>
                  </span>
              </a>
          </li>
          <li class="mb-6">
              <a href="{{ route('userShow') }}">
                  <span class="flex items-center gap-3 text-white text-xl">
                      <i class="fas fa-user"></i>
                      <p>User</p>
                  </span>
              </a>
          </li>
          <li class="mb-6">
              <a href="{{ route('register') }}">
                  <span class="flex items-center gap-3 text-white text-xl">
                      <i class="fas fa-coins"></i>
                      <p>Finance</p>
                  </span>
              </a>
          </li>
          <li>
              <a href="{{ route('events.adminIndex') }}">
                  <span class="flex items-center gap-3 text-white text-xl">
                    <i class="fas fa-calendar-check"></i>
                      <p>Events</p>
                  </span>
              </a>
          </li>
      </ul>
  </div>
</div>
<div class="mb-4 text-white">
  <div class="ml-16 p-2">
    <form method="POST" action="{{ route('custom.logout') }}">
        @csrf
        <button id="logoutForm" type="submit" onclick="submitLogoutForm()" class="items-center flex gap-2 text-lg rounded">
            <i class="fas fa-arrow-right-from-bracket text-xl"></i><p class="">Logout</p>
        </button>
    </form>
</div>
</div>
