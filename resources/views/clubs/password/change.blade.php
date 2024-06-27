@extends('layout.club')
@section('clubs')
<div class="flex justify-center items-center h-screen pt-4">
    <div class="w-full max-w-md">
        <h3 class="text-center text-xl font-semibold mb-6">Change Password</h3>
        
        <form class="bg-white rounded px-8 pt-6 pb-8 mb-4" action="{{ route('postChangePassword') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="current_password" class="block text-gray-700 text-sm font-bold mb-2">Current Password</label>
                <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="current_password" name="current_password">
            </div>
            <div class="mb-4">
                <label for="new_password" class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
                <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="new_password" name="new_password">
            </div>
            <div class="mb-4">
                <label for="new_password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
                <input type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="new_password_confirmation" name="new_password_confirmation">
            </div>
            <div class="flex items-center justify-center">
                <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection