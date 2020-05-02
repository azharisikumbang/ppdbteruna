@extends('templates.base')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 my-10">
        <div name="nav">
            <ul class="flex justify-between">
              <li class="mr-3">
                <ul class="py-3">
                    <li class="inline-block w-6 bg-green-400 h-5 border-radius">&nbsp;</li>
                    <li class="inline-block w-6 bg-green-400 h-5 border-radius">&nbsp;</li>
                    <li class="inline-block w-6 bg-gray-400 h-5 border-radius">&nbsp;</li>
                    <li class="inline-block w-6 bg-gray-400 h-5 border-radius">&nbsp;</li>
                    <li class="inline-block w-6 bg-gray-400 h-5 border-radius">&nbsp;</li>
                </ul>
              </li>
              <li class="mr-3">
                <a class="inline-block py-2 px-4 text-gray-400" href="{{ url('/siswa') }}">{{ $username }}</a>
                <a class="inline-block py-2 px-4 text-gray-400" href="{{ url('/keluar') }}">Keluar</a>
              </li>
            </ul>
        </div>

        <!-- Form -->
        <div class="my-16 text-gray-700 px-40 mx-auto">
            <div class="text-2xl mb-3">Form Pemberkasan</div>
            @if($message)
                {!! getErrorMessage($message) !!}
            @endif
            <form class="w-full" method="POST" action="{{ url('/siswa/pemberkasan') }}">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
                        Nama Depan
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="nama_depan" type="text" placeholder="Arifin" autofocus="autofocus">
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="lastname">
                        Nama Belakang
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="nama_belakang" type="text" placeholder="Muhammad">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                        Tempat Lahir
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tempat_lahir" type="text" placeholder="Padangsidimpuan">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
                        Tanggal Lahir
                      </label>
                      <div class="relative">
                         <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tanggal_lahir" type="date">
                      </div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                        Alamat
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="alamat" type="text" placeholder="alamat lengkap">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                        Kota
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="kota" type="text" placeholder="Padangsidimpuan">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
                        Provinsi
                      </label>
                      <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="provinsi">
                          @foreach($provinsi as $prov)
                            <option value="{{ $prov['name'] }}">{{ $prov['name'] }}</option>
                          @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zip">
                        No. Handphone
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="handphone" type="text" placeholder="08xxxxxxxxxx">
                    </div>
                </div>


                <div class="flex mt-8">
                    <div class="text-white shadow text-center bg-green-400 rounded-full px-4 py-2 m-2 hover:bg-green-500">
                        <button type="submit">Lanjutkan</button>
                    </div>
                    <div class="text-gray-700 shadow text-center bg-white-400 rounded-full px-4 py-2 m-2 hover:bg-gray-100">
                        <a href="#">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
