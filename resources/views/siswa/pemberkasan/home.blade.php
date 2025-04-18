@extends('templates.base')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
<div class="bg-white shadow-md rounded px-6 pt-6 pb-8 m-2">
  <div name="nav">
    <ul class="flex justify-between">
      <li class="mr-3">
        <ul class="py-3">
          <li class="inline-block w-3 bg-green-400 h-3 rounded-full">&nbsp;</li>
          <li class="inline-block w-3 bg-green-400 h-3 rounded-full">&nbsp;</li>
          <li class="inline-block w-3 bg-gray-400 h-3 rounded-full">&nbsp;</li>
          <li class="inline-block w-3 bg-gray-400 h-3 rounded-full">&nbsp;</li>
          <li class="inline-block w-3 bg-gray-400 h-3 rounded-full">&nbsp;</li>
          <li class="inline-block w-3 bg-gray-400 h-3 rounded-full">&nbsp;</li>
        </ul>
      </li>
      <li class="text-right">
        <div class="flex relative inline-block">
          <div class="relative text-sm">
            <button id="userButton" class="flex items-center focus:outline-none ">
              <svg class="svg-icon w-8 h-10" viewBox="0 0 20 20">
                <path fill="lightgray"
                  d="M3.314,4.8h13.372c0.41,0,0.743-0.333,0.743-0.743c0-0.41-0.333-0.743-0.743-0.743H3.314
                                    c-0.41,0-0.743,0.333-0.743,0.743C2.571,4.467,2.904,4.8,3.314,4.8z M16.686,15.2H3.314c-0.41,0-0.743,0.333-0.743,0.743
                                    s0.333,0.743,0.743,0.743h13.372c0.41,0,0.743-0.333,0.743-0.743S17.096,15.2,16.686,15.2z M16.686,9.257H3.314
                                    c-0.41,0-0.743,0.333-0.743,0.743s0.333,0.743,0.743,0.743h13.372c0.41,0,0.743-0.333,0.743-0.743S17.096,9.257,16.686,9.257z">
                </path>
              </svg>
            </button>
            <div id="userMenu"
              class="bg-white nunito rounded shadow-md mt-2 absolute mt-12 top-0 right-0 min-w-full overflow-auto z-30 invisible w-64">
              <ul class="list-reset">
                <li>
                  <a href="{{ url('/siswa') }}"
                    class="px-4 py-2 block text-gray-900 hover:bg-green-300 hover:text-white no-underline hover:no-underline">
                    Hi, {{ $username }}</a>
                </li>
                <li>
                  <a href="{{ url('/change') }}"
                    class="px-4 py-2 block text-gray-900 hover:bg-green-300 hover:text-white no-underline hover:no-underline">Ganti
                    Password</a>
                </li>
                <li>
                  <hr class="border-t mx-2 border-gray-300">
                </li>
                <li><a href="{{ url('/keluar') }}"
                    class="px-4 py-2 block text-gray-900 hover:bg-green-300 hover:text-white no-underline hover:no-underline">Keluar</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>

  <!-- Form -->
  <div class="my-6 text-gray-700">
    @if (session('redirect_message'))
    '<div class="flex items-center bg-blue-500 mb-2 rounded text-white text-sm font-bold px-4 py-3" role="alert">
      <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path
          d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
      </svg>
      <p>{{ session('redirect_message') }}</p>
    </div>';
    @endif

    <div class="text-2xl mb-3">Form Pemberkasan</div>
    <form class="w-full" method="POST" action="{{ url('/siswa/pemberkasan') }}" enctype="multipart/form-data">
      @csrf
      <div class="flex flex-wrap -mx-3 xl:mb-6">
        <div class="w-full px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
            Nama Lengkap <span class="text-red-500">*</span>
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            name="nama_lengkap" type="text" autofocus="autofocus" value="{{ old('nama_lengkap') }}">
          @error('nama_lengkap')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 xl:mb-6">
        <div class="w-full px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
            Pas Photo ( 3 X 4 / Warna ) - max: 2 MB - format: (jpg/jpeg/png) <span class="text-red-500">*</span>
          </label>
          <small class="italic text-gray-700">jika gagal mohon unggah kembali.</small>
          <input class="appearance-none block w-full text-gray-700 py-3 mb-3 leading-tight" name="photo" type="file"
            required>
          @error('photo')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 xl:mb-6">
        <div class="w-full px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
            No. Induk Kependudukan <span class="text-red-500">*</span>
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            name="nik" type="text" maxlength="16" value="{{ old('nik') }}" required>
          @error('nik')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 xl:mb-6">
        <div class="w-full px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
            Jenis Kelamin <span class="text-red-500">*</span>
          </label>
          <input class="text-gray-700 py-3 px-4 mb-3 mr-2" name="jenis_kelamin" type="radio" value="L" {{
            (old('jenis_kelamin')=='L' ) ? 'checked=checked' : '' }}> Laki - Laki
          <input class="text-gray-700 py-3 px-4 mb-3 ml-4 mr-2" name="jenis_kelamin" type="radio" value="P" {{
            (old('jenis_kelamin')=='P' ) ? 'checked=checked' : '' }}> Perempuan
          @error('jenis_kelamin')
          <div>
            <small class="text-red-500 text-sm italic">{{ $message }}</small>
          </div>
          @enderror
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 xl:mb-6">
        <div class="w-full xl:w-1/2 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
            Tempat Lahir <span class="text-red-500">*</span>
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="tempat_lahir" type="text" value="{{ old('tempat_lahir') }}" required>
          @error('tempat_lahir')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>
        <div class="w-full xl:w-1/2 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
            Tanggal Lahir <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <input
              class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              name="tanggal_lahir" type="date" value="{{ old('tanggal_lahir') }}" required>
          </div>
          @error('tanggal_lahir')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 xl:mb-6">
        <div class="w-full xl:w-2/6 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
            Keberadaan Orang Tua
            <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <select
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              name="status_orangtua" required>
              @foreach($orangtua_pendaftar as $orangtua)
              <option value="{{ $orangtua }}" {{ old('status_orangtua')==$orangtua ? 'selected' : '' }}>{{
                ucfirst($orangtua) }}</option>
              @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg>
            </div>
            @error('status_orangtua')
            <small class="text-red-500 text-sm italic">{{ $message }}</small>
            @enderror
          </div>
        </div>
        <div class="w-full xl:w-2/6 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
            Status Pendaftar Di Keluarga
            <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <select
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              name="status_anak" required>
              @foreach($status_pendaftar as $status)
              <option value="{{ $status }}" {{ old('status_anak')==$status ? 'selected' : '' }}>{{ ucfirst($status) }}
              </option>
              @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg>
            </div>
            @error('status_anak')
            <small class="text-red-500 text-sm italic">{{ $message }}</small>
            @enderror
          </div>
        </div>
        <div class="w-full xl:w-1/6 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
            Anak Ke
            <span class="text-red-500">*</span>
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="urutan_dalam_keluarga" type="number" value="{{ old('urutan_dalam_keluarga', 1) }}" step="1" required>
          @error('urutan_dalam_keluarga')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>
        <div class="w-full xl:w-1/6 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
            Jumlah Bersaudara
            <span class="text-red-500">*</span>
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="jumlah_bersaudara" type="number" value="{{ old('jumlah_bersaudara', 1) }}" step="1" required>
          @error('jumlah_bersaudara')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 xl:mb-6">
        <div class="w-full xl:w-1/3 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
            Agama Siswa
            <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <select
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              name="agama" required>
              @foreach($agama_pendaftar as $agama)
              <option value="{{ $agama }}" {{ old('agama')==$agama ? 'selected' : '' }}>{{ ucfirst($agama) }}</option>
              @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg>
            </div>
            @error('agama')
            <small class="text-red-500 text-sm italic">{{ $message }}</small>
            @enderror
          </div>
        </div>
        <div class="w-full xl:w-1/3 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
            Golongan Darah
            <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <select
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              name="golongan_darah" required>
              <option value="-" {{ old('golongan_darah')=='-' ? 'selected' : '' }}> -- Tidak Tahu --
              </option>
              <option value="A" {{ old('golongan_darah')=='A' ? 'selected' : '' }}>A
              </option>
              <option value="B" {{ old('golongan_darah')=='B' ? 'selected' : '' }}>B
              </option>
              <option value="AB" {{ old('golongan_darah')=='A' ? 'selected' : '' }}>
                AB</option>
              <option value="O" {{ old('golongan_darah')=='O' ? 'selected' : '' }}>O
              </option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg>
            </div>
            @error('golongan_darah')
            <small class="text-red-500 text-sm italic">{{ $message }}</small>
            @enderror
          </div>
        </div>
        <div class="w-full xl:w-1/3 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zip">
            No. Telepon
            <span class="text-red-500">*</span>
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="nomor_handphone" type="text" value="{{ old('nomor_handphone') }}" required>
          @error('nomor_handphone')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 xl:mb-6">
        <div class="w-full px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
            Alamat Tempat Tinggal
            <span class="text-red-500">*</span>
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="alamat" type="text" value="{{ old('alamat') }}" required>
          @error('alamat')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 xl:mb-6">
        <div class="w-full xl:w-1/6 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
            RT
            <span class="text-red-500">*</span>
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="rt" type="number" value="{{ old('rt', 0) }}" min=1 required>
          @error('rt')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>
        <div class="w-full xl:w-1/6 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
            RW
            <span class="text-red-500">*</span>
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="rw" type="number" value="{{ old('rw', 0)  }}" min=1 required>
          @error('rw')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>
        <div class="w-full xl:w-2/6 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
            Desa / Kelurahan
            <span class="text-red-500">*</span>
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="desa" type="text" value="{{ old('desa') }}" required>
          @error('desa')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>

        <div class="w-full xl:w-2/6 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zip">
            Kecamatan
            <span class="text-red-500">*</span>
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="kecamatan" type="text" value="{{ old('kecamatan') }}" required>
          @error('kecamatan')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 xl:mb-6">
        <div class="w-full xl:w-1/3 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
            Kota
            <span class="text-red-500">*</span>
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="kota" type="text" value="{{ old('kota') }}" required>
          @error('kota')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>
        <div class="w-full xl:w-1/3 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
            Provinsi
            <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <select
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              name="provinsi" required>
              @foreach($provinsi as $prov)
              <option value="{{ $prov['name'] }}" {{ old('provinsi')==$prov ? 'selected' : '' }}>{{ $prov['name'] }}
              </option>
              @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg>
            </div>
            @error('provinsi')
            <small class="text-red-500 text-sm italic">{{ $message }}</small>
            @enderror
          </div>
        </div>
        <div class="w-full xl:w-1/3 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zip">
            Kode POS
            <span class="text-red-500">*</span>
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="kode_pos" type="text" value="{{ old('kode_pos') }}" maxlength="10" required>
          @error('kode_pos')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 xl:mb-6">
        <div class="w-full md:w-3/4 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
            Alat Transportasi Ke Sekolah
            <span class="text-red-500">*</span>
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:transportasi-none focus:bg-white focus:border-gray-500"
            name="transportasi" type="text" value="{{ old('transportasi') }}" required>
          @error('transportasi')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>
        <div class="w-full md:w-1/4 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
            Jarak Tempat Tinggal (KM)
            <span class="text-red-500">*</span>
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="jarak_rumah_sekolah" value="{{ old('jarak_rumah_sekolah', 0) }}" type="number" step="0.1" min=0
            required>
          @error('jarak_rumah_sekolah')
          <small class="text-red-500 text-sm italic">{{ $message }}</small>
          @enderror
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 xl:mb-6">
        <div class="w-full xl:w-1/2 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
            Apakah Penerima KPS/KIP/KKS/PKH
            <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <select
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              name="jenis_bantuan_pemerintah" required>
              @foreach($bantuan_pendaftar as $item)
              <option value="{{ $item }}" {{ old('jenis_bantuan_pemerintah')==$item ? 'selected' : '' }}>{{
                ucwords($item) }}</option>
              @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg>
            </div>
            @error('jenis_bantuan_pemerintah')
            <small class="text-red-500 text-sm italic">{{ $message }}</small>
            @enderror
          </div>
        </div>
        <div class="w-full xl:w-1/2 px-3 mb-6 xl:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zip">
            Jenis Tempat Tinggal
            <span class="text-red-500">*</span>
          </label>
          <div class="relative">
            <select
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              name="kepemilikan_rumah" required>
              @foreach($home_pendaftar as $item)
              <option value="{{ $item }}" {{ old('kepemilikan_rumah')==$item ? 'selected' : '' }}>{{ ucwords($item) }}
              </option>
              @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg>
            </div>
            @error('kepemilikan_rumah')
            <small class="text-red-500 text-sm italic">{{ $message }}</small>
            @enderror
          </div>
        </div>
      </div>

      <div class="flex justify-start -mx-3 mt-6">
        <div
          class="w-full md:w-64 xl:w-64 xg:w-64 text-white shadow text-center bg-green-400 rounded px-4 py-2 m-2 hover:bg-green-500">
          <button type="submit">Simpan dan Lanjutkan</button>
        </div>
        <div
          class="w-full md:w-64 xl:w-64 xg:w-64 text-white shadow text-center bg-red-400 rounded px-4 py-2 m-2 hover:bg-red-500">
          <button type="reset">Kembali</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection