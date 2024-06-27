@extends('layout.user')

@section('users')
    <div class="flex flex-col">
        <div class="relative w-full h-screen">
            <img src="{{ asset('assets/home/studentclub1.jpg') }}" class="w-full h-full object-cover absolute top-0 left-0">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="absolute inset-0 flex flex-col text-center p-4">
                <p class="text-white text-5xl mb-10 mt-32">Explore ClubConnect</p>
                <div class="flex justify-center">
                    <p class="text-white text-lg w-1/3">At ClubConnect, we are more than just a platform; we are a community of enthusiasts and learners. Connect with people who share your passions, participate in exciting events, and make lifelong friends.</p>
                </div>
                <div class="flex flex-col gap-4 justify-center items-center p-4 my-6 mt-20">
                    <div class="relative p-3 rounded-2xl w-full max-w-lg">
                        <input id="searchInput" type="text" class="rounded-2xl p-3 w-full outline-none" placeholder="Search Events">
                        <div id="searchResults" class="hidden absolute bg-white rounded-2xl shadow-lg w-full mt-1 z-10"></div>
                        <button id="searchButton" type="button" class="absolute right-6 top-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </button>
                    </div>
                </div>                
            </div>
        </div>
        
        <div class="w-full flex flex-col items-center p-10 bg-gray-100">
            <p class="text-3xl font-semibold mb-8">Clubs</p>
            <div class="flex flex-wrap gap-10 items-center justify-center">
                @foreach($clubs as $club)
                <div class="flex flex-col items-center">
                    <img src="{{ asset('assets/' . $club->logo) }}" class="w-32 h-20 object-contain mb-4">
                    <div class="text-xl font-medium">{{$club->name}}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');
        const searchButton = document.getElementById('searchButton');

        searchInput.addEventListener('input', function () {
            const searchTerm = searchInput.value.trim().toLowerCase();
            if (searchTerm.length === 0) {
                searchResults.classList.add('hidden');
                searchResults.innerHTML = '';
                return;
            }

            fetch(`/events/search?q=${encodeURIComponent(searchTerm)}`)
                .then(response => response.json())
                .then(data => {
                    const events = data.events;
                    if (events.length > 0) {
                        const resultsHtml = events.map(event => {
                            return `<a href="/events/users/${event.id}" class="block px-4 py-2 hover:bg-gray-200">${event.title}</a>`;
                        }).join('');
                        searchResults.innerHTML = resultsHtml;
                        searchResults.classList.remove('hidden');
                    } else {
                        searchResults.innerHTML = '<p class="px-4 py-2 text-gray-500">No results found.</p>';
                        searchResults.classList.remove('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error fetching search results:', error);
                });
        });

        searchButton.addEventListener('click', function () {
            const searchTerm = searchInput.value.trim().toLowerCase();
            if (searchTerm.length > 0) {
                window.location.href = `/events/users/${encodeURIComponent(searchTerm)}`;
            }
        });

        document.addEventListener('click', function (event) {
            if (!searchResults.contains(event.target)) {
                searchResults.classList.add('hidden');
            }
        });
    });
</script>