@extends('layout.user')

@section('users')

<main class="login-form  my-10">

  <div class="container mx-auto">

    <div class="flex justify-center">

      <div class="w-full max-w-md">

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

          <div class="mb-4 text-xl text-center">Forgot Password</div>

          @if (Session::has('message'))
          <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p class="font-bold">Success</p>
            <p>{{ Session::get('message') }}</p>
          </div>
          @endif

          <form action="{{ route('forget.password.post') }}" method="POST">

            @csrf

            <div class="mb-4">
              <label for="email_address" class="block text-gray-700 text-sm font-bold mb-2">E-Mail Address</label>
              <input type="text" id="email_address" class="form-input w-full outline-none p-2 border border-gray-200 rounded" name="email" required autofocus>
              @if ($errors->has('email'))
              <span class="text-sm text-red-500">{{ $errors->first('email') }}</span>
              @endif
            </div>

            <div class="flex items-center justify-between">
              <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Send Password Reset Link
              </button>
            </div>

          </form>

        </div>

      </div>

    </div>

  </div>

</main>

@endsection
