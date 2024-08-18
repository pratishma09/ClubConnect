@extends('layout.user')

@section('users')
<section class="bg-[#765fa2] dark:bg-[#765fa2]" id="verify">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
        <div class="mb-4">
            <div class="mb-6 max-w-3xl text-center sm:text-center md:mx-auto md:mb-12">
                <p class="text-base font-semibold uppercase tracking-wide text-blue-200 dark:text-blue-200">
                    Verification
                </p>
                <h2 class="font-heading mb-4 font-bold tracking-tight text-white dark:text-white text-3xl sm:text-5xl">
                    Enter Your Verification Code
                </h2>
            </div>
        </div>
        <div class="flex items-stretch justify-center">
            <div class="card h-fit max-w-md p-5" id="form">
                <h2 class="mb-4 text-2xl font-bold dark:text-white">Verify Your Code</h2>
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="POST" action="/verify">
                    @csrf
                    <div class="mb-6">
                        <div class="mx-0 mb-4">
                            <label for="code" class="pb-1 text-xs uppercase tracking-wider text-white">Verification Code</label>
                            <input type="text" id="code" name="code" placeholder="Enter verification code" class="mb-2 w-full rounded-md border border-gray-400 py-2 pl-2 pr-4 shadow-md outline-none" value="{{ old('code') }}" required>
                            @error('code')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="w-full bg-[#899de8] text-white px-6 py-3 font-xl rounded-md">Verify</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
