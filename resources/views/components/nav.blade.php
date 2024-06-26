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
      
      color: rgb(152, 107, 152);
    }
  
    
  </style>
  
  <header class="bg-white shadow-lg h-24 flex justify-evenly sticky">
    <a href="/" class="border flex items-center px-4 lg:px-6 xl:px-8">
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
          <a href="{{route('aboutus')}}">
            <span>About</span>
          </a>
        </li>
        <li class="p-3 xl:p-6">
          <a href="{{route('clubs.userclub')}}">
            <span>Clubs</span>
          </a>
        </li>
        <li class="p-3 xl:p-6">
          <a href="{{route('userevent')}}">
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
        <a href="/login">
            <button class="bg-purple-400 hover:bg-purple-500 text-white font-bold px-4 xl:px-6 py-2 xl:py-3 rounded">Login</button>
        </a>
        
      </div>
  </header>