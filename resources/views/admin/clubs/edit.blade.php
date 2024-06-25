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
                            <div
                                class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium bg-white transform translate-y-1/2 uppercase">
                                Edit Club
                            </div>
                        </div>

                        <div class="mx-auto max-w-xs">
                            <form method="POST" action="{{ route('clubs.update', $club->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mt-5">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Club Name</label>
                                    <select
                                        class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                        name="name" id="name" required>
                                        @foreach($users as $user)
                                            <option value="{{ $user->name }}" {{ $user->name == $club->name ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-5">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description of Club</label>
                                    <textarea
                                        class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                        name="description" id="description" placeholder="Description of Club" required rows="10" cols="10">{{ $club->description }}</textarea>
                                </div>

                                <div class="mt-5">
                                    <label for="president" class="block text-sm font-medium text-gray-700">President</label>
                                    <input
                                        class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                        type="text" name="president" id="president" placeholder="President" value="{{ $club->president }}" required />
                                </div>

                                <div class="mt-5">
                                    <label for="vice_president" class="block text-sm font-medium text-gray-700">Vice President</label>
                                    <input
                                        class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                        type="text" name="vice_president" id="vice_president" placeholder="Vice President" value="{{ $club->vice_president }}" required />
                                </div>

                                <div class="mt-5">
                                    <label for="tenure_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                    <input
                                        class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                        type="date" name="tenure_date" id="tenure_date" placeholder="Start Date" value="{{ $club->tenure_date }}" required />
                                </div>

                                <input type="hidden" name="user_id" value="{{ $club->user_id }}" required />

                                <div class="mt-5">
                                    <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                                    <input
                                        class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                        type="file" name="logo" id="logo" accept=".jpg, .jpeg, .png" />
                                    @if ($club->logo)
                                        <div class="mt-2">
                                            <img id="logo-preview" src="{{ asset('assets/' . $club->logo) }}" alt="Club Logo" class="w-32 h-32">
                                        </div>
                                    @else
                                        <div class="mt-2">
                                            <img id="logo-preview" src="#" alt="Club Logo" class="w-32 h-32 hidden">
                                        </div>
                                    @endif
                                </div>

                                <button type="submit"
                                    class="mt-5 tracking-wide font-semibold bg-palette text-white-500 w-full py-4 rounded-lg hover:bg-green-200 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                    <span>Update</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('logo').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('logo-preview');
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
                preview.onload = function() {
                    URL.revokeObjectURL(preview.src);
                }
            }
        });
    </script>
@endsection
