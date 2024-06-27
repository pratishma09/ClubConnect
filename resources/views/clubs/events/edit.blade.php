@extends('layout.club')
@section('clubs')
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
                                Edit Event
                            </div>
                        </div>
                        <div class="mx-auto max-w-xs">
                            <form method="POST" action="{{ route('events.update', $event->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />

                                <input class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    type="text" name="title" placeholder="Event Title" value="{{ $event->title }}" required />
                                <textarea class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    type="text" name="description" placeholder="Description of Event" required rows="10" cols="10">{{ $event->description }}</textarea>
                                <input class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    type="date" name="date" placeholder="Date" value="{{ $event->date }}" required />
                                <input class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                    type="number" name="budget" placeholder="Budget" value="{{ $event->budget }}" required />

                                <div class="mt-5">
                                    <label for="photo" class="block text-sm font-medium text-gray-700">Event Photo</label>
                                    <input class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                        type="file" name="photo" id="photo" accept=".jpg, .jpeg, .png" />
                                    @if ($event->photo)
                                        <div class="mt-2">
                                            <img id="photo-preview" src="{{ asset('assets/' . $event->photo) }}" alt="Event Photo" class="w-32 h-32">
                                        </div>
                                    @else
                                        <div class="mt-2">
                                            <img id="photo-preview" src="#" alt="Event Photo" class="w-32 h-32 hidden">
                                        </div>
                                    @endif
                                </div>

                                <button type="submit"
                                    class="mt-5 tracking-wide font-semibold bg-palette text-white-500 w-full py-4 rounded-lg hover:bg-green-200 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none text-white">
                                    <span>Update</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.getElementById('photo').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            const preview = document.getElementById('photo-preview');
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            preview.onload = function() {
                URL.revokeObjectURL(preview.src);
            }
        }
    });
</script>
