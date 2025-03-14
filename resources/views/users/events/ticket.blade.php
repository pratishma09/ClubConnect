@extends('layout.user')

@section('users')
<div class="flex flex-col items-center justify-center min-h-screen bg-center bg-cover"
        style="background-image: url('https://images.unsplash.com/photo-1519750157634-b6d493a0f77c?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
        <div class="absolute  opacity-80 inset-0 z-0"></div>
        <div class="max-w-md w-full h-full mx-auto z-10 bg-purple-900 rounded-3xl">
            <div class="flex flex-col">
                <div class="bg-white relative drop-shadow-2xl rounded-3xl p-4 m-4">
                    <div class="flex-none sm:flex">
                        <div class="relative h-32 w-32 sm:mb-0 mb-3 hidden">
                            <img src="{{ asset('assets/' . $event->photo) }}"  alt="Event Image" class="w-32 h-32 object-cover rounded-2xl">
                        </div>
                        <div class="flex-auto justify-evenly">
                            <p class="ml-auto text-blue-800">Ticket ID: {{$idtick}}</p>
                            <div class="flex items-center justify-between">
                                
                                <div class="flex items-center my-1">
                                    <h2 class="font-medium">{{ $event->title }}</h2>
                                </div>
                                <div class="ml-auto text-blue-800">{{ $event->date }}</div>
                            </div>
                            <div class="border-b border-dashed border-b-2 my-5"></div>
                            <div class="flex items-center">
                                
                                <div class="flex flex-col mx-auto">
                                    <img src="{{ asset('assets/' . $event->photo) }}" class="w-40 p-1">
                                </div>
                                <div class="flex flex-col">
                                    <div class="w-full flex-none text-lg text-blue-800 font-bold leading-none">Club</div>
                                    <div class="text-xs">{{ $event->user->name }}@if($event->collaborator)||{{$event->collaborator}}@endif</div>
                                </div>
                            </div>
                            <div class="border-b border-dashed border-b-2 my-5 pt-5">
                                <div class="absolute rounded-full w-5 h-5 bg-blue-900 -mt-2 -left-2"></div>
                                <div class="absolute rounded-full w-5 h-5 bg-blue-900 -mt-2 -right-2"></div>
                            </div>
                            <div class="flex items-center mb-5 p-5 text-sm">
                                <div class="flex flex-col">
                                    <span class="text-sm">Ticket Count</span>
                                    <div class="font-semibold">{{ $ticket->ticket_count }}</div>
                                </div>
                                <div class="flex flex-col ml-auto">
                                    <span class="text-sm">Total Price</span>
                                    <div class="font-semibold">{{ $ticket->ticket_count * $event->price }}</div>
                                </div>
                            </div>
                            <div class="border-b border-dashed border-b-2 my-5 pt-5">
                                <div class="absolute rounded-full w-5 h-5 bg-blue-900 -mt-2 -left-2"></div>
                                <div class="absolute rounded-full w-5 h-5 bg-blue-900 -mt-2 -right-2"></div>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('ticket.download', ['ticketId' => $ticket->id]) }}" class="bg-purple-600 text-white px-4 py-2 rounded-md shadow-lg hover:bg-purple-700">Download Ticket</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection