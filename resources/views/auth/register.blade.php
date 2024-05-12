@extends('layout.auth')
@section('content')
    <div class="min-h-screen bg-gray-100 text-gray-900 md:flex justify-center">
        <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg md:flex justify-center flex-1">
            <div class="lg:w-1/2 p-6 sm:p-12">
                <div>
                    <img src="{{ asset('assets/logo.png') }}" class="mx-auto w-40" />
                </div>
                
                <div class="flex flex-col items-center">
                    <div class="w-full flex-1">

                        <div class="my-12 border-b text-center">
                            <div class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium bg-white transform translate-y-1/2 uppercase">
                                Create Club
                            </div>
                        </div>

                        <div class="mx-auto max-w-xs">
                            <form method="POST" action="{{ route('clubregister') }}">
                                @csrf
                                <select
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                    name="role" hidden>
                                    <option value="club" selected>Club</option>
                                </select>
                                <input
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    type="text" name="name" placeholder="Club Name" required />
                                <input
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    type="email" name="email" placeholder="Email" required />
                                    <div class="hidden">
                                <input
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    type="password" name="password" placeholder="Password" value="defaultpassword" required />
                                <input type="hidden" name="password_confirmation" value="defaultpassword">
                            </div>
                                <button
                                    type="submit"
                                    class="mt-5 tracking-wide font-semibold bg-palette text-white-500 w-full py-4 rounded-lg hover:bg-green-200 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                    
                                    <span class="ml-">
                                        Create
                                    </span>
                                </button>
                            </form>
                            <p class="mt-6 text-xs text-gray-600 text-center">
                                By registering, clubs agree to our
                                <a href="#" class="border-b border-gray-500 border-dotted">
                                    Terms of Service
                                </a>
                                
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="bg-purple-100 text-center hidden md:flex">
                <div class="w-full">
                    <img src="{{ asset('assets/auth/register.png') }}" class="h-full w-full mx-auto bg" />
                </div>
            </div> --}}
        </div>
    </div>
@endsection
