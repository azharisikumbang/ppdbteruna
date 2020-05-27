@extends('templates.admin')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
    <h3 class="text-xl mb-3 font-bold pb-3">
        Perbaharui Data Sekolah #{{ $data->id_registration }}
        <small>(<a class="text-sm hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" href="{{ url('/admin/detail/' . $data->id_registration ) }}">kembali</a>)</small>

    </h3>
    <div class=" bg-white p-6 shadow rounded-md">
      <div class="pr-10">
        <!-- Form -->
        <div class="text-gray-700">
            @if(isset($message))
                {!! getErrorMessage($message) !!}
            @endif
            <form class="w-full" method="POST" action="{{ url('/admin/perbaharui/sekolah/' . $data->id_registration) }}">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                        Nama Sekolah Tujuan
                      </label>
                      <input type="hidden" name="_token" value="{{ $csrf_token }}">
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="destionation_school" type="text" value="SMK Swasta Teruna Padangsidimpuan" readonly="readonly">
                    </div>
                    <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
                        Jurusan
                      </label>
                      <div class="relative">
                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="jurusan" autofocus="autofocus">
                            <option value="Ak">-- PILIH JURUSAN --</option>
                          @foreach(config('custom.data.jurusan') as $key => $value)
                            <option value="{{ $key }}" {{ strtolower($data['student']->majoring_student) == strtolower($key) ? 'selected=selected' : '' }}>{{ $value }}</option>
                          @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
                        Nama Sekolah Asal
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="sekolah_asal" type="text" value="{{ $data['score']->school_score }}">
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
                       No. Induk Siswa Nasional (NISN)
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="nisn" type="text" maxlength="10" value="{{ $data['score']->nisn_score }}">
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
                       No. Peserta UN SMP / MTS
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="no_peserta_un" type="text" value="{{ $data['score']->no_peserta_un }}">
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_total">
                        No. Ijazah SMP / MTS
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="nomor_ijazah" type="text" value="{{ $data['score']->nomor_ijazah }}">
                    </div>
                    <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_ratarata">
                        Tanggal Ijazah SMP / MTS
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tanggal_ijazah" type="date" value="{{ $data['score']->tanggal_ijazah }}">
                    </div>
                </div>
                 <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_total">
                        No. SKHUN SMP / MTS
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="nomor_skhun" type="text" value="{{ $data['score']->nomor_skhun }}">
                    </div>
                    <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_ratarata">
                        Tanggal SKHUN SMP / MTS
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tanggal_skhun" type="date" value="{{ $data['score']->tanggal_skhun }}">
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_mtk">
                        Nilai Matemtika
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="nilai_mtk" type="number" value="{{ $data['score']->mtk_score }}" step="0.01">
                    </div>
                    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_bindo">
                        Nilai B. Indonesia
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="nilai_bindo" type="number" value="{{ $data['score']->indo_score }}" step="0.01">
                    </div>
                    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_binggris">
                        Nilai B. Inggris
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="nilai_binggris" type="number" value="{{ $data['score']->inggris_score }}" step="0.01">
                    </div>
                    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_ipa">
                        Nilai IPA
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="nilai_ipa" type="number" value="{{ $data['score']->ipa_score }}" step="0.01">
                    </div>
                </div>

                 <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_total">
                        Nilai Total UN
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="nilai_total" type="number" value="{{ $data['score']->total_score }}" step="0.01">
                    </div>
                    <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_ratarata">
                        Nilai Rata Rata UN
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="nilai_ratarata" type="number" value="{{ $data['score']->rata_rata_score }}" step="0.01">
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
