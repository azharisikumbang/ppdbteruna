@extends('templates.base')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
  <div class="w-full max-w-sm mx-auto mt-20">

    @if($message)
        {!! getErrorMessage($message) !!}
    @endif
    <form class="bg-white shadow-md rounded px-6 pt-6 pb-8 m-2" method="POST" action="{{ url('/masuk') }}">
      <div class="mb-3 text-center ">
        <h3 class="font-bold text-lg text-gray-700">Silahkan Masuk</h3>
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
        <!-- <p class="text-red-500 text-xs italic">Please choose a password.</p> -->
      </div>
      <div class="flex items-center justify-between mb-6">
        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Masuk
        </button>
        <a class="inline-block align-baseline font-bold text-sm text-green-500 hover:text-green-800" href="{{ url('/daftar') }}">
          Belum Punya Akun?
        </a>
      </div>
      <p class="text-center text-gray-700 text-xs">
        &copy;2020 SMK Swasta Teruna Padangsidimpuan
      </p>
    </form>

  </div>
@endsection
