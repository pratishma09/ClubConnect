@extends('layout.user')
@section('users')
    <div class="min-h-screen bg-gray-100 text-gray-900 md:flex justify-center">
        <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg md:flex justify-center flex-1">
            <div class="lg:w-1/2 p-6 sm:p-12">
                <div>
                    <img src="{{ asset('assets/logo.png') }}" class="mx-auto h-20" />
                    <p class="text-center text-purple-700 font-semibold italic">Join us at ClubConnect</p>
                </div>
                
                <div class="flex flex-col w-full items-center">
                    <div class=" w-full">


                        <div class="my-12 border-b text-center">
                            <div
                                class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium bg-white transform translate-y-1/2 uppercase">
                                Sign In With E-mail
                            </div>
                        </div>

                        <div class="mx-auto max-w-xs">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                {{-- <select
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                    name="role">
                                    <option disabled selected><p class="text-gray-500">Role</p></option>
                                    <option value="club">Club</option>
                                    <option value="admin">Admin</option> <!-- Assuming this should be 'admin' for admin role -->
                                </select> --}}
                                <input
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    type="email" name="email" placeholder="Email" />
                                <input
                                    class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    type="password" name="password" placeholder="Password" />
                                <button
                                    type="submit"
                                    class="mt-5 tracking-wide font-semibold bg-palette text-white-500 w-full py-4 rounded-lg hover:bg-purple-600 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                    
                                    <span class=" text-white ">
                                        Sign In
                                    </span>
                                </button>
                            </form>
                            <p class="mt-6 text-xs text-gray-600 text-center">
                                <a href="{{route('forget.password.get')}}" class="border-b border-gray-500 border-dotted">
                                    Forgot Password?
                                </a>
                                
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-purple-100 text-center w-2/3 hidden md:flex">
                <div class=""
                    ><img src="{{ asset('assets/club.jpg') }}" class="h-full w-full mx-auto bg" />
                </div>
            </div>
        </div>
    </div>
@endsection
