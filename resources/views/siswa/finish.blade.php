@extends('templates.base')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
    <div class="bg-white shadow-md rounded px-4 pt-2 pb-8 m-2">
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
              <li class="text-right">
                <div class="flex relative inline-block">
                    <div class="relative text-sm">
                        <button id="userButton" class="flex items-center focus:outline-none ">
                            <svg class="svg-icon w-8 h-10" viewBox="0 0 20 20">
                                <path fill="lightgray" d="M3.314,4.8h13.372c0.41,0,0.743-0.333,0.743-0.743c0-0.41-0.333-0.743-0.743-0.743H3.314
                                    c-0.41,0-0.743,0.333-0.743,0.743C2.571,4.467,2.904,4.8,3.314,4.8z M16.686,15.2H3.314c-0.41,0-0.743,0.333-0.743,0.743
                                    s0.333,0.743,0.743,0.743h13.372c0.41,0,0.743-0.333,0.743-0.743S17.096,15.2,16.686,15.2z M16.686,9.257H3.314
                                    c-0.41,0-0.743,0.333-0.743,0.743s0.333,0.743,0.743,0.743h13.372c0.41,0,0.743-0.333,0.743-0.743S17.096,9.257,16.686,9.257z"></path>
                            </svg>
                        </button>
                        <div id="userMenu" class="bg-white nunito rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible w-64">
                            <ul class="list-reset">
                                <li>
                                    <a href="{{ url('/siswa') }}" class="px-4 py-2 block text-gray-900 hover:bg-green-300 hover:text-white no-underline hover:no-underline"> Hi, {{ $username }}</a>
                                </li>
                                <li class="px-4 py-2 block text-gray-900 hover:bg-green-300 hover:text-white no-underline hover:no-underline">
                                    No Pendaftaran : #{{ $registration_id }}
                                </li>
                                <li>
                                    <a href="{{ url('/change') }}" class="px-4 py-2 block text-gray-900 hover:bg-green-300 hover:text-white no-underline hover:no-underline">Ganti Password</a>
                                </li>
                                <li>
                                    <hr class="border-t mx-2 border-gray-300">
                                </li>
                                <li><a href="{{ url('/keluar') }}" class="px-4 py-2 block text-gray-900 hover:bg-green-300 hover:text-white no-underline hover:no-underline">Keluar</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
              </li>
            </ul>
        </div>

        <div class="my-6 text-gray-700  text-center">
            <div class="text-4xl">{{ $message['title'] }}</div>
            <div class="text-xl">
                {{ $message['body'] }}
            </div>
            <div class="mt-4 w-3/4 mx-auto text-sm">
                <p>Silahkan unduh dan cetak dokumen biodata dan bukti intergrasi berikut untuk selanjutnya dilakukan validasi pada saat pendaftaran ulang. {{ $message['desc'] }}</p>
            </div>

            <div class="flex justify-center mt-6 text-sm flex-col sm:flex-col md:flex-col lg:flex-row xl:flex-row">
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
