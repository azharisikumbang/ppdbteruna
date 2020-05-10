@extends('templates.base')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 my-10 text-center">
        <div id="nav">
            <ul class="flex justify-between">
              <li class="mr-3">
                <ul class="py-3">
                    <li class="inline-block w-3 bg-green-400 h-3 rounded-full">&nbsp;</li>
                    <li class="inline-block w-3 bg-green-400 h-3 rounded-full">&nbsp;</li>
                    <li class="inline-block w-3 bg-green-400 h-3 rounded-full">&nbsp;</li>
                    <li class="inline-block w-3 bg-green-400 h-3 rounded-full">&nbsp;</li>
                    <li class="inline-block w-3 bg-green-400 h-3 rounded-full">&nbsp;</li>
                    <li class="inline-block w-3 bg-green-400 h-3 rounded-full">&nbsp;</li>
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
            <div class="text-4xl">{{ $message['title'] }}</div>
            <div class="text-xl">
                {{ $message['body'] }}
            </div>
            <div class="mt-4 w-3/4 mx-auto">
                <p>Silahkan unduh dan cetak dokumen biodata dan bukti intergrasi berikut untuk selanjutnya dilakukan validasi pada saat pendaftaran ulang. {{ $message['desc'] }}</p>
            </div>

            <div class="flex justify-center mt-6">
                <div class="text-white shadow text-center bg-green-400 rounded-full px-4 py-2 m-2 hover:bg-green-500">
                    <a href="{{ url('/siswa/download?file=biodata') }}">Unduh Biodata</a>
                </div>
                <div class="text-white shadow text-center bg-green-400 rounded-full px-4 py-2 m-2 hover:bg-green-500">
                    <a href="{{ url('/siswa/download?file=integrasi') }}">Unduh Tanda Integrasi</a>
                </div>
            </div>
        </div>
    </div>
@endsection
