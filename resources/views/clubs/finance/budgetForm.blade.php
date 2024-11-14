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
                            Update Budget Utilization
                        </div>
                    </div>
                    <div class="mx-auto max-w-xs">
                        <h1 class="text-center text-xl font-semibold mb-5">{{ $event->title }}</h1>
                        <form method="POST" action="{{ route('events.update_budget', $event->id) }}">
                            @csrf
                            @method('PUT')

                            <input class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                type="number" id="amount_spent" name="amount_spent" placeholder="Amount Spent" value="{{ $event->clubs()->where('club_id', $club->id)->first()->pivot->amount_spent ?? 0 }}" min="0" required />

                            <button type="submit"
                                class="mt-5 tracking-wide font-semibold bg-palette text-white-500 w-full py-4 rounded-lg hover:bg-green-200 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none text-white">
                                <span>Update Budget</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
