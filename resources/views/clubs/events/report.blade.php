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
                                Edit Event Report
                            </div>
                        </div>
                        <div class="mx-auto max-w-xs">
                            <form method="POST" action="{{ route('events.report.update', $event->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mt-5">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Event Title</label>
                                    <input class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                        type="text" name="title" id="title" value="{{ $event->title }}" placeholder="Event Title" required />
                                </div>

                                <div class="mt-5">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Description of Event</label>
                                    <textarea class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                        name="description" id="description" placeholder="Description of Event" required rows="5">{{ $event->description }}</textarea>
                                </div>

                                <div class="mt-5">
                                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <input class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                        type="date" name="date" id="date" value="{{ $event->date }}" placeholder="Date" required />
                                </div>

                                <div class="mt-5">
                                    <label for="budget" class="block text-sm font-medium text-gray-700">Budget</label>
                                    <input class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                        type="number" name="budget" id="budget" value="{{ $event->budget }}" placeholder="Budget" required />
                                </div>

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

                                <div class="mt-5">
                                    <label for="report_description" class="block text-sm font-medium text-gray-700">Report Description</label>
                                    <textarea class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                        name="report_description" value="report_description" id="report_description"  required rows="10">{{ $event->report_description }}</textarea>
                                </div>

                                <div class="mt-5">
                                    <label for="no_of_participants" class="block text-sm font-medium text-gray-700">Number of Participants</label>
                                    <input class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" type="number"
                                        name="no_of_participants" id="no_of_participants" value="{{$event->no_of_participants}}" required>
                                </div>

                                <div class="mt-5">
                                    <label for="report_images" class="block text-sm font-medium text-gray-700">Report Images</label>
                                    <input class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                        type="file" name="report_images[]" id="report_images" accept=".jpg, .jpeg, .png" multiple />
                                    @if ($event->report_images)
                                        <div class="mt-2">
                                            @foreach (json_decode($event->report_images) as $image)
                                                <img src="{{ asset('assets/' . $image) }}" alt="Report Image" class="w-32 h-32 inline-block">
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <button type="submit"
                                    class="mt-5 tracking-wide font-semibold bg-palette text-white-500 w-full py-4 rounded-lg hover:bg-green-200 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none text-white">
                                    <span>Update Report</span>
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
