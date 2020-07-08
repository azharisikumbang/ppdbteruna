@extends('templates.admin')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
    <h3 class="text-xl mb-3 font-bold pb-3">
        Perbaharui Biodata #{{ $data->registration_id }}
        <small>(<a class="text-sm hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" href="{{ url('/admin/detail/' . $data->id_registration ) }}">kembali</a>)</small>

    </h3>
    <div class=" bg-white p-6 shadow rounded-md">
      <div class="pr-10">
        <!-- Form -->
        <div class="text-gray-700">
            <div class="text-2xl mb-3">Form Pemberkasan</div>
            @if(isset($message))
                {!! getErrorMessage($message) !!}
            @endif
            <form class="w-full" method="post" action="{{ url('/admin/perbaharui/biodata/' . $data->id_registration) }}">
                <div class="flex flex-wrap -mx-3 xl:mb-6">
                    <div class="w-full px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
                        Nama Lengkap
                      </label>
                      <input type="hidden" name="_token" value="{{ $csrf_token }}">
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="nama_depan" type="text" autofocus="autofocus" value="{{ $data['student']->name_student }}">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 xl:mb-6">
                    <div class="w-full px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
                        No. Induk Kependudukan
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="nik_siswa" type="text" maxlength="16" value="{{ $data['student']->nik_student }}">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 xl:mb-6">
                    <div class="w-full px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
                        Jenis Kelamin
                      </label>
                      <input class="text-gray-700 py-3 px-4 mb-3 mr-2" name="jenis_kelamin" type="radio" value="L" {{ ($data['student']->gender_student == 'L') ? 'checked=checked' : '' }} > Laki - Laki
                      <input class="text-gray-700 py-3 px-4 mb-3 ml-4 mr-2" name="jenis_kelamin" type="radio" value="P" {{ ($data['student']->gender_student != 'L') ? 'checked=checked' : '' }}> Perempuan
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 xl:mb-6">
                    <div class="w-full xl:w-1/2 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                        Tempat Lahir
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tempat_lahir" type="text" value="{{ $data['student']->birthplace_student }}">
                    </div>
                    <div class="w-full xl:w-1/2 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
                        Tanggal Lahir
                      </label>
                      <div class="relative">
                         <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tanggal_lahir" type="date" value="{{ $data['student']->birthdate_student }}">
                      </div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 xl:mb-6">
                    <div class="w-full xl:w-2/6 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
                        Keberadaan Orang Tua
                      </label>
                      <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="orangtua">
                          @foreach(config('custom.orangtua_pendaftar') as $orangtua)
                            <option value="{{ $orangtua }}" {{ ($data['student']->parent_student == $orangtua) ? 'selected=selected' : '' }}>{{ ucfirst($orangtua) }}</option>
                          @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                    </div>
                    <div class="w-full xl:w-2/6 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                        Status Pendaftar
                      </label>
                      <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="status">
                          @foreach(config('custom.status_pendaftar') as $status)
                            <option value="{{ $status }}" {{ ($data['student']->status_student == $status) ? 'selected=selected' : '' }}>{{ ucfirst($status) }}</option>
                          @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                    </div>
                    <div class="w-full xl:w-1/6 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                        Anak Ke
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="child_order" type="number" value="{{ $data['student']->child_order_student ?? 1 }}" step="1" >
                    </div>
                    <div class="w-full xl:w-1/6 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                        Jmlh Saudara
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="siblings" type="number"  value="{{ $data['student']->siblings_student ?? 1 }}" step="1">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 xl:mb-6">
                    <div class="w-full xl:w-1/3 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
                        Agama
                      </label>
                      <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="agama">
                          @foreach(config('custom.agama_pendaftar') as $agama)
                            <option value="{{ $agama }}" {{ ($data['student']->agama_student == $agama) ? 'selected=selected' : '' }}>{{ ucfirst($agama) }}</option>
                          @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                    </div>
                    <div class="w-full xl:w-1/3 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                        Golongan Darah
                      </label>
                      <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="blood">
                            <option value="A" {{ ($data['student']->blood_student == 'A') ? 'selected=selected' : '' }}>A</option>
                            <option value="B" {{ ($data['student']->blood_student == 'B') ? 'selected=selected' : '' }}>B</option>
                            <option value="AB" {{ ($data['student']->blood_student == 'AB') ? 'selected=selected' : '' }}>AB</option>
                            <option value="O" {{ ($data['student']->blood_student == 'O') ? 'selected=selected' : '' }}>O</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                    </div>
                    <div class="w-full xl:w-1/3 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zip">
                        No. Telepon
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="handphone" type="text" value="{{ $data['student']->phone_student }}">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 xl:mb-6">
                    <div class="w-full px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                        Alamat
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="alamat" type="text" value="{{ $data['student']->address_student }}">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 xl:mb-6">
                    <div class="w-full xl:w-1/6 px-3 mb-6 xl:mb-0">
                       <?php
                        $rt_rw = explode("/", $data['student']->rt_rw_student);
                       ?>
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                        RT
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="rt" type="number" value="{{ $rw_rw[0] ?? 1 }}">
                    </div>
                    <div class="w-full xl:w-1/6 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                        RW
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="rw" type="number" value="{{ $rt_rw[1] ?? 1 }}">
                    </div>
                    <div class="w-full xl:w-2/6 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                        Desa / Kelurahan
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="desa" type="text" value="{{ $data['student']->desa_student }}">
                    </div>

                    <div class="w-full xl:w-2/6 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zip">
                        Kecamatan
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="kecamatan" type="text" value="{{ $data['student']->kecamatan_student }}">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 xl:mb-6">
                    <div class="w-full xl:w-1/3 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                        Kota
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="kota" type="text" value="{{ $data['student']->kota_student }}">
                    </div>
                    <div class="w-full xl:w-1/3 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
                        Provinsi
                      </label>
                      <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="provinsi">
                          @foreach(config('custom.provinsi') as $prov)
                            <option value="{{ $prov['name'] }}" {{ ($data['student']->provinsi_student == $prov['name']) ? 'selected=selected' : '' }}>{{ $prov['name'] }}</option>
                          @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                    </div>
                    <div class="w-full xl:w-1/3 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zip">
                        Kode POS
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="pos" type="text" value="{{ $data['student']->pos_student }}" maxlength="6">
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 xl:mb-6">
                    <div class="w-full md:w-3/4 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                        Alat Transportasi Ke Sekolah
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="transport" type="text" value="{{ $data['student']->transport_student }}">
                    </div>
                    <div class="w-full md:w-1/4 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zip">
                        Jarak (KM)
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="distance" value="{{ $data['student']->distance_student }}" type="number" step="0.1">
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 xl:mb-6">
                    <div class="w-full xl:w-1/2 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                        Apakah Penerima KPS/KIP/KKS/PKH
                      </label>
                      <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="accommodation">
                          @foreach(config('custom.bantuan_pendaftar') as $item)
                            <option value="{{ $item }}" {{ (strtolower($data['student']->accommodation_student) == strtolower($item))  ? 'selected=selected' : ''}}>{{ ucwords($item) }}</option>
                          @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                    </div>
                    <div class="w-full xl:w-1/2 px-3 mb-6 xl:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zip">
                        Jenis Tempat Tinggal
                      </label>
                      <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="home">
                          @foreach(config('custom.home_pendaftar') as $item)
                            <option value="{{ $item }}" {{ (strtolower($data['student']->home_student) == strtolower($item))  ? 'selected=selected' : ''}}>{{ ucwords($item) }}</option>
                          @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="flex justify-end -mx-3 mt-6 xl:mb-6">
                    <div class="w-full md:w-32 xl:w-32 xg:w-32 text-white shadow text-center bg-green-400 rounded px-4 py-2 m-2 hover:bg-green-500">
                        <button type="submit">Perbaharui</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>

@endsection
