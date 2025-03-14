<!-- component -->
<footer class=" bg-purple-100/80 font-sans">
    <div class="container px-6 py-12 mx-auto">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 sm:gap-y-10 lg:grid-cols-4">
            <div class="sm:col-span-2">
                <h1 class="max-w-lg text-xl font-semibold tracking-tight text-gray-800 xl:text-2xl dark:text-black">Subscribe our club portal for more updates.</h1>

                
                <form method="POST" action="{{ route('subscribe.store') }}" class="flex flex-col space-y-4 md:w-1/2 mx-auto">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email" class="border-gray-500 border p-3 rounded-md focus:outline-none focus:border-purple-500">
                    <button type="submit" class="bg-purple-500 text-white px-4 py-3 rounded-md hover:bg-purple-600 transition-colors focus:outline-none">Subscribe</button>
                </form>
            </div>

            <div>
                <p class="font-semibold text-gray-800 dark:text-black">Quick Link</p>

                <div class="flex flex-col items-start mt-5 space-y-2">
                    <a href="/" class="text-gray-500 transition-colors duration-300 dark:text-gray-500 dark:hover:text-palette hover:underline hover:cursor-pointer hover:text-palette">Home</a>
                    <a class="text-gray-500 transition-colors duration-300 dark:text-gray-500 dark:hover:text-palette hover:underline hover:cursor-pointer hover:text-palette">Who We Are</a>
                    <a href="/contact" class="text-gray-500 transition-colors duration-300 dark:text-gray-500 dark:hover:text-palette hover:underline hover:cursor-pointer hover:text-palette">Contacts</a>
                </div>
            </div>

            <div>
                <p class="font-semibold text-gray-800 dark:text-black">Popular</p>

                <div class="flex flex-col items-start mt-5 space-y-2">
                    <a class="text-gray-500 transition-colors duration-300 dark:text-gray-500 dark:hover:text-palette hover:underline hover:cursor-pointer hover:text-palette">Clubs</a>
                    <a class="text-gray-500 transition-colors duration-300 dark:text-gray-500 dark:hover:text-palette hover:underline hover:cursor-pointer hover:text-palette">Upcoming Events</a>
                    <a class="text-gray-500 transition-colors duration-300 dark:text-gray-500 dark:hover:text-palette hover:underline hover:cursor-pointer hover:text-palette">Reports</a>
                    
                </div>
            </div>
        </div>
        
        <hr class="my-6 border-gray-200 md:my-8 dark:border-gray-500 h-2" />
        
        <div class="sm:flex sm:items-center sm:justify-between">
            
            
            <div class="flex gap-4 hover:cursor-pointer">
                <img src="https://www.svgrepo.com/show/303114/facebook-3-logo.svg" width="30" height="30" alt="fb" />
                <img src="https://www.svgrepo.com/show/303115/twitter-3-logo.svg" width="30" height="30" alt="tw" />
                <img src="https://www.svgrepo.com/show/303145/instagram-2-1-logo.svg" width="30" height="30" alt="inst" />
                <img src="https://www.svgrepo.com/show/94698/github.svg" class="" width="30" height="30" alt="gt" />
                <img src="https://www.svgrepo.com/show/22037/path.svg" width="30" height="30" alt="pn" />
                <img src="https://www.svgrepo.com/show/28145/linkedin.svg" width="30" height="30" alt="in" />
                <img src="https://www.svgrepo.com/show/22048/dribbble.svg" class="" width="30" height="30" alt="db" />
            </div>
        </div>
        <p class="font-sans p-8 text-start md:text-center md:text-lg md:p-4">© {{date("Y")}} ClubConnect. All rights reserved.</p>
    </div>
</footer>