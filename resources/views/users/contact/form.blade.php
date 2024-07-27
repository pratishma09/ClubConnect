@extends('layout.user')

@section('users')
<section class="bg-blue-50 dark:bg-[#765fa2]" id="contact">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
        <div class="mb-4">
            <div class="mb-6 max-w-3xl text-center sm:text-center md:mx-auto md:mb-12">
                <p class="text-base font-semibold uppercase tracking-wide text-blue-600 dark:text-blue-200">
                    Contact
                </p>
                <h2 class="font-heading mb-4 font-bold tracking-tight text-white dark:text-white text-3xl sm:text-5xl">
                    Get in Touch
                </h2>
            </div>
        </div>
        <div class="flex items-stretch justify-center">
            <div class="grid md:grid-cols-2">
                <div class="h-full pr-6">
                    <p class="mt-20 mb-5 text-lg text-white">
                        Join discussions, share your experiences, and connect with other members through our integrated community forums. 
                        <p class="mt-3 mb-12 text-lg text-white">If you have any questions or need assistance, please don't hesitate to reach out to us at :
                            </p>
                    </p>
                    <ul class="mb-5 md:mb-0">
                        <li class="flex">
                            <div class="flex h-10 w-10 items-center justify-center rounded bg-[#899de8] text-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="h-6 w-6">
                                    <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                    <path
                                        d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4 mb-4">
                                <h3 class="mb-2 text-lg font-medium leading-6 text-white dark:text-white">Our Address</h3>
                                <p class="text-white">Sifal, Kathmandu</p>
                            </div>
                        </li>
                        <li class="flex">
                            <div class="flex h-10 w-10 items-center justify-center rounded bg-[#899de8] text-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="h-6 w-6 ">
                                    <path
                                        d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2">
                                    </path>
                                    <path d="M15 7a2 2 0 0 1 2 2"></path>
                                    <path d="M15 3a6 6 0 0 1 6 6"></path>
                                </svg>
                            </div>
                            <div class="ml-4 mb-4">
                                <h3 class="mb-2 text-lg font-medium leading-6 text-white dark:text-white">Contact</h3>
                                <p class="text-white">Mobile: +977-9862361790</p>
                            </div>
                        </li>
                        <li class="flex">
                            <div class="flex h-10 w-10 items-center justify-center rounded bg-[#899de8] text-gray-50">
                                <svg viewBox="0 0 8 6" width="24" height="24" stroke-width="0.5" stroke-linecap="round"
                                stroke-linejoin="round" fill="none" class="text-white" stroke="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m0 0h8v6h-8zm.75 .75v4.5h6.5v-4.5zM0 0l4 3 4-3v1l-4 3-4-3z"/>
                                </svg>                        
                            </div>
                            <div class="ml-4 mb-4">
                                <h3 class="mb-2 text-lg font-medium leading-6 text-white dark:text-white">Email</h3>
                                <p class="text-white">clubconnect@gmail.com</p>
                                
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card h-fit max-w-6xl p-5 md:pb-12" id="form">
                    <h2 class="mb-4 text-2xl font-bold dark:text-white">Ready to Get Started?</h2>
                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="mb-6">
                            <div class="mx-0 mb-1 sm:mb-4">
                                <label for="name" class="pb-1 text-xs uppercase tracking-wider text-white ">Name</label>
                                <input type="text" id="name" name="name" placeholder="Your name" class="mb-2 w-full rounded-md border border-gray-400 py-2 pl-2 pr-4 shadow-md outline-none  sm:mb-0" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mx-0 mb-1 sm:mb-4">
                                <label for="email" class="pb-1 text-xs uppercase tracking-wider text-white ">Email</label>
                                <input type="email" id="email" name="email" placeholder="Your email address" class="mb-2 w-full rounded-md border border-gray-400 py-2 pl-2 pr-4 shadow-md outline-none  sm:mb-0" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mx-0 mb-1 sm:mb-4">
                                <label for="phone" class="pb-1 text-xs uppercase tracking-wider text-white">Phone</label>
                                <input type="text" id="phone" name="phone" placeholder="Your phone number" class="mb-2 w-full rounded-md border border-gray-400 py-2 pl-2 pr-4 shadow-md outline-none  sm:mb-0" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mx-0 mb-1 sm:mb-4">
                                <label for="message" class="pb-1 text-xs uppercase tracking-wider text-white ">Message</label>
                                <textarea id="message" name="message" cols="30" rows="5" placeholder="Write your message..." class="mb-2 w-full rounded-md border border-gray-400 py-2 pl-2 pr-4 shadow-md outline-none sm:mb-0" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="w-full bg-[#899de8] text-white px-6 py-3 font-xl rounded-md sm:mb-0">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
