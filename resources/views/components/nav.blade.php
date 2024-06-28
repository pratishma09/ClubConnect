<header class="bg-white shadow-lg h-24 flex justify-between items-center px-4 lg:px-6 xl:px-8 sticky top-0 z-40">
  <a href="/" class="flex items-center px-2 lg:px-4 xl:px-6">
      <img class="h-10 object-contain" src="{{ asset('assets/logo.png') }}" alt="Logo" />
  </a>
  <!-- Mobile Menu Button -->
  <button id="mobile-menu-button" class="block lg:hidden px-2 focus:outline-none z-50">
      <svg class="h-6 w-6 fill-current text-gray-900" viewBox="0 0 24 24">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6C2 5.44772 2.44772 5 3 5H21C21.5523 5 22 5.44772 22 6C22 6.55228 21.5523 7 21 7H3C2.44772 7 2 6.55228 2 6ZM3 11C2.44772 11 2 11.4477 2 12C2 12.5523 2.44772 13 3 13H21C21.5523 13 22 12.5523 22 12C22 11.4477 21.5523 11 21 11H3ZM3 17C2.44772 17 2 17.4477 2 18C2 18.5523 2.44772 19 3 19H21C21.5523 19 22 18.5523 22 18C22 17.4477 21.5523 17 21 17H3Z"/>
      </svg>
  </button>
  <!-- Navigation Links -->
  <nav id="mobile-menu" class="hidden lg:flex flex-grow justify-center items-center">
      <ul class="flex justify-between items-center space-x-4">
          <li class="p-2 lg:p-3">
              <a href="{{ route('home') }}" class="text-gray-900 hover:text-purple-600">Home</a>
          </li>
          <li class="p-2 lg:p-3">
              <a href="{{ route('aboutus') }}" class="text-gray-900 hover:text-purple-600">About</a>
          </li>
          <li class="p-2 lg:p-3">
              <a href="{{ route('clubs.userclub') }}" class="text-gray-900 hover:text-purple-600">Clubs</a>
          </li>
          <li class="p-2 lg:p-3">
              <a href="{{ route('userevent') }}" class="text-gray-900 hover:text-purple-600">Events</a>
          </li>
          <li class="p-2 lg:p-3">
              <a href="{{ route('contact.form') }}" class="text-gray-900 hover:text-purple-600">Contact</a>
          </li>
      </ul>
  </nav>
  <!-- Login Button -->
  <div class="hidden lg:flex items-center">
      <a href="/login">
          <button class="bg-purple-400 hover:bg-purple-500 text-white font-bold px-4 xl:px-6 py-2 xl:py-3 rounded">
              Login
          </button>
      </a>
  </div>
</header>

<!-- Mobile Menu (hidden by default) -->
<div id="mobile-menu-dropdown" class="lg:hidden fixed top-0 left-0 right-0 bottom-0 bg-white z-40 shadow-lg overflow-y-auto transform transition-transform duration-300 -translate-y-full">
  <div class="flex justify-end p-4">
      <button id="mobile-menu-close" class="focus:outline-none">
          <svg class="h-6 w-6 fill-current text-gray-900" viewBox="0 0 24 24">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41Z"/>
          </svg>
      </button>
  </div>
  <ul class="flex flex-col items-center justify-center mt-4 space-y-4">
      <li class="p-2">
          <a href="{{ route('home') }}" class="text-gray-900 hover:text-purple-600">Home</a>
      </li>
      <li class="p-2">
          <a href="{{ route('aboutus') }}" class="text-gray-900 hover:text-purple-600">About</a>
      </li>
      <li class="p-2">
          <a href="{{ route('clubs.userclub') }}" class="text-gray-900 hover:text-purple-600">Clubs</a>
      </li>
      <li class="p-2">
          <a href="{{ route('userevent') }}" class="text-gray-900 hover:text-purple-600">Events</a>
      </li>
      <li class="p-2">
          <a href="{{ route('contact.form') }}" class="text-gray-900 hover:text-purple-600">Contact</a>
      </li>
      <li class="p-2">
          <a href="/login" class="bg-purple-400 hover:bg-purple-500 text-white font-bold px-4 py-2 rounded">
              Login
          </a>
      </li>
  </ul>
</div>

<script>
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');
  const mobileMenuDropdown = document.getElementById('mobile-menu-dropdown');
  const mobileMenuClose = document.getElementById('mobile-menu-close');

  mobileMenuButton.addEventListener('click', () => {
      mobileMenuDropdown.classList.toggle('-translate-y-full');
  });

  mobileMenuClose.addEventListener('click', () => {
      mobileMenuDropdown.classList.toggle('-translate-y-full');
  });
</script>
