@extends('templates.base')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 my-10 text-center">
        <div id="nav">
            <ul class="flex justify-between">
              <li class="mr-3">
                <ul class="py-3">
                    <li class="inline-block w-3 bg-green-400 h-3 rounded-full">&nbsp;</li>
                    <li class="inline-block w-3 bg-gray-400 h-3 rounded-full">&nbsp;</li>
                    <li class="inline-block w-3 bg-gray-400 h-3 rounded-full">&nbsp;</li>
                    <li class="inline-block w-3 bg-gray-400 h-3 rounded-full">&nbsp;</li>
                    <li class="inline-block w-3 bg-gray-400 h-3 rounded-full">&nbsp;</li>
                    <li class="inline-block w-3 bg-gray-400 h-3 rounded-full">&nbsp;</li>
                </ul>
              </li>
              <li class="mr-3">
                <a class="inline-block py-2 px-4 text-gray-400" href="{{ url('/siswa') }}">{{ $username }}</a>
                <a class="inline-block py-2 px-4 text-gray-400" href="{{ url('/keluar') }}">Keluar</a>
              </li>
            </ul>
        </div>

        <div class="my-10 text-gray-700">
            <div class="text-4xl">Selamat!</div>
            <div class="text-xl">Akun anda berhasil didaftarkan.</div>
            <div class="mt-4 max-w-lg mx-auto">
                <p>sebelum melanjutkan pendaftaran diharapkan anda membaca aturan dan tata tertib sekolah, administrasi dan pembiayaan peserta didik</p>
            </div>

            <div class="flex justify-center mt-6">
                <div class="text-gray-700 shadow text-center bg-white-400 rounded-full px-4 py-2 m-2 hover:bg-gray-100">
                    <a href="#">Aturan dan Tata Terbib</a>
                </div>
                <div class="text-gray-700 shadow text-center bg-white-400 rounded-full px-4 py-2 m-2 hover:bg-gray-100">
                    <a href="#">Administrasi dan Pembiayaan</a>
                </div>
                <div class="text-white shadow text-center bg-green-400 rounded-full px-4 py-2 m-2 hover:bg-green-500">
                    <a href="{{ url('/siswa/pemberkasan') }}">Lanjutkan Pendaftaran</a>
                </div>
            </div>
        </div>
    </div>
@endsection
