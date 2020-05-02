@extends('templates.base')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 my-10 text-center">
        <div id="nav">
            <ul class="flex justify-between">
              <li class="mr-3">
                <ul class="py-3">
                    <li class="inline-block w-6 bg-green-400 h-5 border-radius">&nbsp;</li>
                    <li class="inline-block w-6 bg-green-400 h-5 border-radius">&nbsp;</li>
                    <li class="inline-block w-6 bg-green-400 h-5 border-radius">&nbsp;</li>
                    <li class="inline-block w-6 bg-green-400 h-5 border-radius">&nbsp;</li>
                    <li class="inline-block w-6 bg-green-400 h-5 border-radius">&nbsp;</li>
                </ul>
              </li>
              <li class="mr-3">
                <span class="inline-block py-2 px-4 text-gray-700 font-bold">
                  No Pendaftaran : #{{ $registration_id }}
                </span>
                <a class="inline-block py-2 px-4 text-gray-400" href="{{ url('/siswa') }}">{{ $username }}</a>
                <a class="inline-block py-2 px-4 text-gray-400" href="{{ url('/keluar') }}">Keluar</a>
              </li>
            </ul>
        </div>

        <div class="my-10 text-gray-700">
            <div class="text-4xl">Terima Kasih!</div>
            <div class="text-xl">Data anda sedang kami diproses.</div>
            <div class="mt-4 w-3/4 mx-auto">
                <p>Silahkan unduh bukti intergrasi berikut dan untuk dilakukan validasi pada saat pendaftaran ulang. Anda juga bisa melakukan pengecekan berkala pada halaman web ini untuk mengetahui perkembangan validasi data anda.</p>
            </div>

            <div class="flex justify-center mt-6">
                <div class="text-white shadow text-center bg-green-400 rounded-full px-4 py-2 m-2 hover:bg-green-500">
                    <a href="{{ url('/siswa/download') }}">Unduh Tanda Integrasi</a>
                </div>
            </div>
        </div>
    </div>
@endsection
