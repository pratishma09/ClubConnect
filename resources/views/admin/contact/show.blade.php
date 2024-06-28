@extends('layout.admin')
@section('content')
<p class="text-xl p-2 font-semibold">Contact</p>
<div class="relative overflow-x-auto shadow-md mt-10">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Message
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr class="bg-white dark:border-gray-700">
                
                <td class="px-6 py-4">
                    {{$contact->name}}
                </td>
                <td class="px-6 py-4">
                    {{$contact->phone}}
                </td>
                <td class="px-6 py-4">
                    {{$contact->email}}
                </td>
                <td class="px-6 py-4">
                    {{$contact->message}}
                </td>
                <td class="px-6 py-4 flex gap-2">
                    
                    <form action="{{ route('contacts.delete', $contact->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    <button class="font-medium text-white dark:text-white py-1 px-2 rounded bg-palette">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
@endsection