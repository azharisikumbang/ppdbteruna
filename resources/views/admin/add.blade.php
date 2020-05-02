@extends('templates.base')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
  <div class="w-full max-w-sm mx-auto mt-20">
    @if($message)
        {!! getErrorMessage($message) !!}
    @endif
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ url('/admin/add') }}">
      <div class="mb-3 text-center ">
        <h3 class="font-bold text-lg text-gray-700">Tambahkan Admin</h3>
      </div>
      <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
              Email
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="email" id="name" type="email" placeholder="Email" autofocus="autofocus">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
          Username
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="username" type="text" placeholder="Username" value="{{ (isset($username)) ? $username : '' }}" autofocus="autofocus">
      </div>
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
          Password
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password" type="password" placeholder="Password">
      </div>
      <div class="flex items-center justify-between mb-6">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Tambahkan
        </button>
      </div>
      <p class="text-center text-gray-700 text-xs">
        &copy;2020 SMK Swasta Teruna Padangsidimpuan
      </p>
    </form>

  </div>
@endsection
