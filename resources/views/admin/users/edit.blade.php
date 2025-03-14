@extends('layout.admin')

@section('content')
<div class="bg-gray-100 text-gray-900 md:flex justify-center">
    <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg md:flex justify-center flex-1">
        <div class="lg:w-1/2 p-6 sm:p-12">
            <div>
                <img src="{{ asset('assets/logo.png') }}" class="mx-auto w-40" />
            </div>
            
            <div class="flex flex-col items-center">
                <div class="w-full flex-1">

                    <div class="my-12 border-b text-center">
                        <div class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium bg-white transform translate-y-1/2 uppercase">
                            Edit User
                        </div>
                    </div>

                    <div class="mx-auto max-w-xs">
                        

                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            
                            <input
                                class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Name" required />
                            <input
                                class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email" required />
                            
                            <button
                                type="submit"
                                class="mt-5 tracking-wide font-semibold bg-palette text-white-500 w-full py-4 rounded-lg hover:bg-green-200 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                
                                <span class="ml-">Update</span>
                            </button>
                        </form>

                        
                        <p class="mt-6 text-xs text-gray-600 text-center">
                            By updating, users agree to our
                            <a href="#" class="border-b border-gray-500 border-dotted">Terms of Service</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>
@endsection
