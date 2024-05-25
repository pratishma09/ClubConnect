<style>
    .header-links li span {
      position: relative;
      z-index: 0;
    }
  
    .header-links li span::before {
      content: '';
      position: absolute;
      z-index: -1;
      bottom: 2px;
      left: -4px;
      right: -4px;
      display: block;
      height: 6px;
    }
  
    .header-links li.active span::before {
      background-color: rgb(152, 107, 152);
    }
  
    .header-links li:not(.active):hover span::before {
      background-color: #ccc;
    }
  </style>
  
  <header class="bg-white shadow-lg h-24 flex justify-evenly">
    <a href="/home" class="border flex items-center px-4 lg:px-6 xl:px-8">
      <img class="h-10 object-contain" src="{{ asset('assets/logo.png') }}" alt="" />
    </a>
    <nav class="header-links contents font-semibold text-base lg:text-lg">
      <ul class="flex w-full items-center justify-end mr-10 ml-4 xl:ml-8">
        <li class="p-3 xl:p-6 active">
          <a href="{{route('home')}}">
            <span>Home</span>
          </a>
        </li>
        <li class="p-3 xl:p-6">
          <a href="">
            <span>About</span>
          </a>
        </li>
        <li class="p-3 xl:p-6">
          <a href="{{route('clubs.index')}}">
            <span>Clubs</span>
          </a>
        </li>
        <li class="p-3 xl:p-6">
          <a href="{{route('events.index')}}">
            <span>Events</span>
          </a>
        </li>
        <li class="p-3 xl:p-6">
            <a href="{{route('contact.form')}}">
              <span>Contact</span>
            </a>
          </li>
        
      </ul>
    </nav>
    <div class="border flex items-center px-4 lg:px-6 xl:px-8">
        <a href="" class="mr-4 lg:mr-6 xl:mr-8">
          <svg class="h-6 xl:h-6" aria-hidden="true" focusable="false" data-prefix="far" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-search fa-w-16 fa-3x"><path fill="currentColor" d="M508.5 468.9L387.1 347.5c-2.3-2.3-5.3-3.5-8.5-3.5h-13.2c31.5-36.5 50.6-84 50.6-136C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c52 0 99.5-19.1 136-50.6v13.2c0 3.2 1.3 6.2 3.5 8.5l121.4 121.4c4.7 4.7 12.3 4.7 17 0l22.6-22.6c4.7-4.7 4.7-12.3 0-17zM208 368c-88.4 0-160-71.6-160-160S119.6 48 208 48s160 71.6 160 160-71.6 160-160 160z"></path></svg>
        </a>
        <a href="/login">
            <button class="bg-black hover:bg-gray-700 text-white font-bold px-4 xl:px-6 py-2 xl:py-3 rounded">Login</button>
        </a>
        
      </div>
  </header>