@extends('templates.admin')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
    <h3 class="text-xl mb-3 font-bold pb-3">
        Perbaharui Biodata #{{ $data->registration_id }}
        <small>(<a class="text-sm hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" href="{{ url('/admin/detail/' . $data->registration_id ) }}">kembali</a>)</small>

    </h3>
    <div class=" bg-white p-6 shadow rounded-md">
      <div class="pr-10">
        <!-- Form -->
        <div class="text-gray-700">
            <div class="text-2xl mb-3">Form Pemberkasan</div>
            @if(isset($message))
                {!! getErrorMessage($message) !!}
            @endif
            <form class="w-full" method="POST" action="{{ url('/admin/perbaharui/ayah/' . $data->registration_id) }}">
                <!-- Ayah -->
                <div class="mt-4 border-b">
                  <div class="text-md font-bold mt-6 mb-3">Orang Tua Laki Laki</div>
                  <div class="flex flex-wrap -mx-3 mb-6">
                      <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
                          Nama Ayah
                        </label>
                        <input type="hidden" name="_token" value="{{ $csrf_token }}">
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="nama_ayah" type="text" autofocus="autofocus" value="{{ $data->nama_ayah }}">
                      </div>
                  </div>
                  <div class="flex flex-wrap -mx-3 mb-6">
                      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                          Tempat Lahir Ayah
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tempat_lahir_ayah" type="text" value="{{ $data['tempat_lahir_ayah'] }}">
                      </div>
                      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
                          Tanggal Lahir ayah
                        </label>
                        <div class="relative">
                           <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tanggal_lahir_ayah" type="date" value="{{ $data->tanggal_lahir_ayah }}">
                        </div>
                      </div>
                  </div>

                  <div class="flex flex-wrap -mx-3 mb-6">
                      <div class="w-full md:w-3/4 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                          Alamat Ayah
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="alamat_ayah" type="text"  value="{{ $data['alamat_ayah'] }}">
                      </div>
                      <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
                          Agama Ayah
                        </label>
                        <div class="relative">
                          <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="agama_ayah">
                            @foreach(config('custom.agama_pendaftar') as $agama)
                              <option value="{{ $agama }}" {{ ($data->agama_ayah == $agama) ? 'selected=selected' : '' }}>{{ ucfirst($agama) }}</option>
                            @endforeach
                          </select>
                          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                          </div>
                        </div>
                      </div>
                  </div>

                  <div class="flex flex-wrap -mx-3 mb-6">
                      <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
                          Pendidikan Ayah
                        </label>
                        <div class="relative">
                          <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="pendidikan_ayah">
                            @foreach(config('custom.pendidikan_orangtua') as $item)
                              <option value="{{ $item }}" {{ ($data->pendidikan_ayah == $item) ? 'selected=selected' : '' }}>{{ ucfirst($item) }}</option>
                            @endforeach
                          </select>
                          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                          </div>
                        </div>
                      </div>
                  </div>


                  <div class="flex flex-wrap -mx-3 mb-6">
                      <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                          Pekerjaan Ayah
                        </label>
                        <div class="relative">
                          <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="pekerjaan_ayah">
                            @foreach(config('custom.pekerjaan_orangtua') as $item)
                              <option value="{{ $item }}" {{ ($data->pekerjaan_ayah == $item) ? 'selected=selected' : '' }}>{{ ucfirst($item) }}</option>
                            @endforeach
                              <option value="lainnya">Lainnya</option>
                          </select>
                          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                          </div>
                        </div>
                      </div>
                      <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
                          Penghasilan Ayah
                        </label>
                        <div class="relative">
                           <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="penghasilan_ayah" type="number" step="500000" value="{{ $data['penghasilan_ayah'] }}">
                        </div>
                      </div>
                      <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                          No. Telepon
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="phone_ayah" type="text"  value="{{ $data['phone_ayah'] }}">
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
