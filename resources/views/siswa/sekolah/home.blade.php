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
          <li class="inline-block w-3 bg-green-400 h-3 rounded-full">&nbsp;</li>
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
                <li
                  class="px-4 py-2 block text-gray-900 hover:bg-green-300 hover:text-white no-underline hover:no-underline">
                  No Pendaftaran : #{{ $registration_id }}
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
    <div class="text-2xl mb-3">Form Pendataan Sekolah</div>
    @if($message)
    {!! getErrorMessage($message) !!}
    @endif
    <form class="w-full" method="POST" action="{{ url('/siswa/sekolah') }}" enctype="multipart/form-data"
      id="form-sekolah">
      @csrf
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
            Nama Sekolah Tujuan
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="destionation_school" type="text" value="SMK Swasta Teruna Padangsidimpuan" readonly="readonly">
        </div>
        <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="state">
            Jurusan
          </label>
          <div class="relative">
            <select
              class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
              name="jurusan" autofocus="autofocus">
              <option value="Ak">-- PILIH JURUSAN --</option>
              @foreach($jurusan as $key => $value)
              <option value="{{ $key }}" {{ (strtolower(old('jurusan'))==strtolower($key)) ? 'selected=selected' : ''
                }}>{{ $value }}</option>
              @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg>
            </div>
          </div>
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
            Nama Sekolah Asal (SMP/MTS/Lainnya)
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            name="sekolah_asal" type="text" value="{{ old('school_score') }}">
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
            No. Induk Siswa Nasional (NISN)
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            name="nisn" type="text" maxlength="10" value="{{ old('nisn_score') }}">
        </div>
      </div>


      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 font-bold mb-2" for="firstname">
            Keterangan Hasil Ujian
          </label>
          <input type="checkbox" name="disable_input_sekolah" class="mt-4"
            onchange="disableInputFile(this, 'nomor_ijazah, no_peserta_un, tanggal_ijazah, nomor_skhun, tanggal_skhun, nilai_mtk, nilai_bindo, nilai_binggris, nilai_ipa, nilai_total, nilai_ratarata, file_ijazah, file_skhun')">
          Tandai Dokumen Belum Lengkap (silahkan lakukan pendataan di waktu lain.)
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
            No. Peserta UN SMP / MTS
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            name="no_peserta_un" type="text" value="{{ old('no_peserta_un') }}">
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_total">
            No. Ijazah SMP / MTS
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="nomor_ijazah" type="text" value="{{ old('nomor_ijazah') }}">
        </div>
        <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_ratarata">
            Tanggal Ijazah SMP / MTS
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="tanggal_ijazah" type="date" value="{{ old('tanggal_ijazah') }}">
        </div>
      </div>
      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_total">
            No. SKHUN SMP / MTS
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="nomor_skhun" type="text" value="{{ old('nomor_skhun') }}">
        </div>
        <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_ratarata">
            Tanggal SKHUN SMP / MTS
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="tanggal_skhun" type="date" value="{{ old('tanggal_skhun') }}">
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_mtk">
            Nilai Matemtika
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="nilai_mtk" type="number" step="0.01" value="{{ old('mtk_score') ?? '0.00' }}" min=0>
        </div>
        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_bindo">
            Nilai B. Indonesia
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="nilai_bindo" type="number" value="{{ old('indo_score') ?? '0.00' }}" step="0.01" min=0>
        </div>
        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_binggris">
            Nilai B. Inggris
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="nilai_binggris" type="number" value="{{ old('inggris_score') ?? '0.00' }}" step="0.01" min=0>
        </div>
        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_ipa">
            Nilai IPA
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="nilai_ipa" type="number" value="{{ old('ipa_score') ?? '0.00' }}" step="0.01" min=0>
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_total">
            Nilai Total UN
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="nilai_total" type="number" value="{{ old('nilai_total') ?? '0.00' }}" step="0.01" min=0>
        </div>
        <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_ratarata">
            Nilai Rata Rata UN
          </label>
          <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="nilai_ratarata" type="number" value="{{ old('nilai_ratarata') ?? '0.00' }}" step="0.01" min=0>
        </div>
      </div>

      <div class="flex flex-wrap -mx-3 mb-6">

        <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_total">
            Bukti Ijazah (photo atau scan dokumen / PDF)
          </label>

          <input
            class="appearance-none block w-full text-gray-700  py-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="file_ijazah" type="file">
        </div>
        <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nilai_ratarata">
            Bukti SKHUN (photo atau scan dokumen / PDF)
          </label>
          <input
            class="appearance-none block w-full text-gray-700 py-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="file_skhun" type="file">
        </div>
      </div>

      <div class="flex justify-end -mx-3 mt-6 xl:mb-6">
        <div
          class="w-full sm:w-full md:w-32 xl:w-32 xg:w-32 text-white shadow text-center bg-green-400 rounded px-4 py-2 m-2 hover:bg-green-500">
          <button type="submit">Lanjutkan</button>
        </div>
        <div
          class="w-full sm:w-full md:w-32 xl:w-32 xg:w-32 text-white shadow text-center bg-gray-400 rounded px-4 py-2 m-2 hover:bg-gray-500">
          <a href="{{ $back_url }}">Kembali</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  let createdElements;
        function disableInputFile(e, element)
        {
          if (createdElements == null) {
            elements = element.split(",");
            createdElements = elements.map(el => {
              el = el.trim();
              el = document.querySelector(`#form-sekolah [name=${el}]`);
              return el;
            });
          }

          createdElements.map(el => {
            if (el.getAttribute('disabled') == "disabled") {
                el.removeAttribute('disabled');
                el.classList.remove('bg-red-100');
                el.value = "";
                return;
            }

            el.setAttribute('disabled', 'disabled');
            el.classList.add('bg-red-100');
            el.value = "pending_document";
            return;

          });
        }
</script>

@endsection