@extends('layout.user')

@section('users')
<main class="login-form">

  <div class="container mx-auto my-10">

    <div class="flex justify-center">

      <div class="w-full max-w-md">

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

          <div class="mb-4 text-xl text-center">Reset Password</div>

          <form action="{{ route('reset.password.post') }}" method="POST" class="">

            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-4">
              <label for="email_address" class="block text-gray-700 text-sm font-bold mb-2">E-Mail Address</label>
              <input type="text" id="email_address" class="form-input w-full outline-none p-2 border border-gray-200 rounded" name="email" required autofocus>
              @if ($errors->has('email'))
              <span class="text-sm text-red-500">{{ $errors->first('email') }}</span>
              @endif
            </div>

            <div class="mb-4">
              <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
              <input type="password" id="password" class="form-input w-full outline-none p-2 border border-gray-200 rounded" name="password" required>
              @if ($errors->has('password'))
              <span class="text-sm text-red-500">{{ $errors->first('password') }}</span>
              @endif
            </div>

            <div class="mb-6">
              <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
              <input type="password" id="password-confirm" class="form-input w-full outline-none p-2 border border-gray-200 rounded" name="password_confirmation" required>
              @if ($errors->has('password_confirmation'))
              <span class="text-sm text-red-500">{{ $errors->first('password_confirmation') }}</span>
              @endif
            </div>

            <div class="flex items-center justify-between">
              <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Reset Password
              </button>
            </div>

          </form>

        </div>

      </div>

    </div>

  </div>

</main>

@endsection
