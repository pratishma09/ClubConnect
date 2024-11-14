@extends('layout.admin')
@section('content')
<div class="relative overflow-x-auto shadow-md">
    <button class="text-white bg-palette rounded m-5 py-1 px-2"><a href="{{route('register')}}">Create Users</a></button>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="bg-white dark:border-gray-700">
                
                <td class="px-6 py-4">
                    {{$user->name}}
                </td>
                <td class="px-6 py-4">
                    {{$user->email}}
                </td>
                <td class="px-6 py-4 flex gap-2">
                    <a href="{{route('users.edit',$user->id)}}" class="font-medium text-white dark:text-white py-1 px-2 rounded bg-palette">Edit</a>
                    <form action="{{ route('users.delete', $user->id) }}" method="POST">
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