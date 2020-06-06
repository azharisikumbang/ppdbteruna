@extends('templates.admin')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
    <h3 class="text-xl mb-3 font-bold pb-3">
        Data Pendaftar #{{ $registrasi->id_registration }}
        @if(isset($registrasi['file'][2]) && $registrasi['file'][2]['type_file'] == 'skhun')
            <small>(<a class="text-sm hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" target="_blank" href="{{ url('/files/biodata/' . $registrasi['file'][5]['name_file']) }}">unduh</a>)</small>
            <small>(<a class="text-sm hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" href="{{ url('/admin/detail/' . $registrasi->id_registration . '/regenerate') }}">re-generate</a>)</small>
        @endif

    </h3>
    <div class="bg-white p-6 shadow rounded-md">
        <div class="grid grid-cols-2">
          <div class="pr-10">
            <table class="w-full">
              <!-- Data Siswa -->
              <tr>
                <td colspan="2" class="font-bold pt-4">
                    Data Diri Pendaftar
                    <small>( <a class="text-sm hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" href="{{ url('/admin/perbaharui/biodata/' . $registrasi->id_registration) }}">perbaharui</a> )</small>
                </td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 ">Nama Siswa</td>
                <td class="border-b py-3 px-3">: {{ $registrasi['student']['name_student'] }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 ">Photo</td>
                <td class="border-b py-3 px-3">:
                    @if(isset($registrasi['file'][0]) && $registrasi['file'][0]['name_file'] != NULL)
                        <a href="{{ url('/files/photo/' . $registrasi['file'][0]->name_file) }}" class="hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" target="_blank">(lihat)</a>
                    @else
                        -
                    @endif
                    ( <a class="hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" href="{{ url('/admin/perbaharui/file/photo/' . $registrasi->id_registration) }}">perbaharui</a> )
                </td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3 bg-gray-200">Tempat Tanggal Lahir</td>
                <td class="border-b px-3 py-3 bg-gray-200">: {{ $registrasi['student']['birthplace_student'] . ', '. tanggal($registrasi['student']['birthdate_student']) }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Alamat</td>
                <td class="border-b px-3 py-3">: {{ $registrasi['student']['address_student'] }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 bg-gray-200">Status Pendaftar</td>
                <td class="border-b py-3 px-3 bg-gray-200">: Anak {{ ucwords($registrasi['student']['status_student']) }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Keberadaan Orang Tua</td>
                <td class="border-b px-3 py-3">: {{ ucwords($registrasi['student']['parent_student']) }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 bg-gray-200">Agama</td>
                <td class="border-b py-3 px-3 bg-gray-200">: {{ ucwords($registrasi['student']['agama_student']) }}</td>
              </tr>
               <tr>
                <td class="border-b px-3 py-3">No. Telp</td>
                <td class="border-b px-3 py-3">: {{ $registrasi['student']['phone_student'] }}</td>
              </tr>
              <!-- Data orang tua -->
              <tr>
                <td colspan="2" class="font-bold pt-6">
                    Data Ayah
                    <small>( <a class="text-sm hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" href="{{ url('/admin/perbaharui/ayah/' . $registrasi->id_registration) }}">perbaharui</a> )</small>
                </td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Nama</td>
                <td class="border-b px-3 py-3">: {{ $registrasi['parent']['nama_ayah'] }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 bg-gray-200">Tempat / Tanggal  Lahir</td>
                <td class="border-b py-3 px-3 bg-gray-200">: {{ $registrasi['parent']['tempat_lahir_ayah'] . ', ' . tanggal($registrasi['parent']['tanggal_lahir_ayah']) }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3">Alamat</td>
                <td class="border-b py-3 px-3">: {{ $registrasi['parent']['alamat_ayah'] }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 bg-gray-200">Pekerjaan</td>
                <td class="border-b py-3 px-3 bg-gray-200">: {{ $registrasi['parent']['pekerjaan_ayah'] }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Penghasilan</td>
                <td class="border-b px-3 py-3">: {{ curr($registrasi['parent']['penghasilan_ayah'], 0, 'Rp. ') }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 bg-gray-200">No. Telp</td>
                <td class="border-b py-3 px-3 bg-gray-200">: {{ $registrasi['parent']['phone_ayah'] }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Agama</td>
                <td class="border-b px-3 py-3">: {{ ucwords($registrasi['parent']['agama_ayah']) }}</td>
              </tr>
              <tr>
                <td colspan="2" class="font-bold pt-6">
                    Data Ibu
                    <small>( <a class="text-sm hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" href="{{ url('/admin/perbaharui/ibu/' . $registrasi->id_registration) }}">perbaharui</a> )</small>
                </td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Nama</td>
                <td class="border-b px-3 py-3">: {{ $registrasi['parent']['nama_ibu'] }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 bg-gray-200">Tempat / Tanggal Lahir</td>
                <td class="border-b py-3 px-3 bg-gray-200">: {{ $registrasi['parent']['tempat_lahir_ibu'] . ', ' . tanggal($registrasi['parent']['tanggal_lahir_ibu']) }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3">Alamat</td>
                <td class="border-b py-3 px-3">: {{ $registrasi['parent']['alamat_ibu'] }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3 bg-gray-200">Pekerjaan</td>
                <td class="border-b px-3 py-3 bg-gray-200">: {{ $registrasi['parent']['pekerjaan_ibu'] }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3">Penghasilan</td>
                <td class="border-b py-3 px-3">: {{ curr($registrasi['parent']['penghasilan_ibu'], 0, 'Rp. ') }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 bg-gray-200">No. Telp</td>
                <td class="border-b py-3 px-3 bg-gray-200">: {{ $registrasi['parent']['phone_ibu'] }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Agama</td>
                <td class="border-b px-3 py-3">: {{ ucwords($registrasi['parent']['agama_ibu']) }}</td>
              </tr>
              <tr>
                <td colspan="2" class="font-bold pt-6">
                    Data Wali
                    <small>( <a class="text-sm hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" href="{{ url('/admin/perbaharui/wali/' . $registrasi->id_registration) }}">perbaharui</a> )</small>
                </td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Nama</td>
                <td class="border-b px-3 py-3">: {{ $registrasi['parent']['nama_wali'] }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 bg-gray-200">Tempat Lahir</td>
                <td class="border-b py-3 px-3 bg-gray-200">: {{ ($registrasi['parent']['nama_wali'] != '') ? $registrasi['parent']['tempat_lahir_wali'] . ', ' . tanggal($registrasi['parent']['tanggal_lahir_wali']) : '' }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3">Pekerjaan</td>
                <td class="border-b py-3 px-3">: {{ ($registrasi['parent']['nama_wali'] != '') ? $registrasi['parent']['pekerjaan_wali'] : '' }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3 bg-gray-200">Penghasilan</td>
                <td class="border-b px-3 py-3 bg-gray-200">: {{ ($registrasi['parent']['nama_wali'] != '') ? curr($registrasi['parent']['penghasilan_wali'], 0, 'Rp. ') : '' }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3">Alamat</td>
                <td class="border-b py-3 px-3">: {{ $registrasi['parent']['alamat_wali'] }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 bg-gray-200">No. Telp</td>
                <td class="border-b py-3 px-3 bg-gray-200">: {{ $registrasi['parent']['phone_wali'] }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Agama</td>
                <td class="border-b px-3 py-3">: {{ ($registrasi['parent']['nama_wali'] != '') ? ucwords($registrasi['parent']['agama_wali']) : '' }}</td>
              </tr>
            </table>
          </div>


          <div>
            <table class="w-full">
              <tr>
                <td colspan="2" class="font-bold pt-6">Data Administrasi</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">No. Pendaftaran</td>
                <td class="border-b px-3 py-3">: {{ $registrasi->id_registration }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3 bg-gray-200">Tanggal Pendaftaran</td>
                <td class="border-b px-3 py-3 bg-gray-200">: {{ tanggal($registrasi->created_at, true) }} WIB</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3">Jurusan</td>
                <td class="border-b py-3 px-3">: {{ config('custom.data.jurusan.' . $registrasi['student']['majoring_student']) }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3 bg-gray-200">Status Pendaftaran</td>
                <td class="border-b px-3 py-3 bg-gray-200">: {{ (($registrasi['file'][1]->name_file == null) || ($registrasi['file'][2]->name_file == null)) ? 'Dokumen belum lengkap' : 'Dokumen telah dilengkapi'}}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3">Aktivitas Pendaftaran</td>
                <td class="border-b py-3 px-3">: {{ $registrasi->current_registration }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3 bg-gray-200">Bukti Pembayaran</td>
                <td class="border-b px-3 py-3 bg-gray-200">: @if(isset($registrasi['payment']['name_payment']))
                        Ya (<a class="text-sm hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" target="_blank" href="{{ url('/files/pembayaran/' . $registrasi['file'][3]['name_file']) }}">unduh</a>)
                      @else
                        -
                      @endif
                </td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3">Bukti Integrasi</td>
                <td class="border-b py-3 px-3">: @if(isset($registrasi['payment']['name_payment']))
                        Ya (<a class="text-sm hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" target="_blank" href="{{ url('/files/integrasi/' . $registrasi['file'][4]['name_file']) }}">unduh</a>)
                      @else
                        -
                      @endif
                </td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3 bg-gray-200">Rekening Pengirim</td>
                <td class="border-b px-3 py-3 bg-gray-200">: {{ $registrasi['payment']['name_payment'] }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3">No. Rekening</td>
                <td class="border-b py-3 px-3">: {{ $registrasi['payment']['number_payment'] }} ( {{ $registrasi['payment']['bank_payment'] }} )</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3 bg-gray-200">Nominal Biaya Transfer</td>
                <td class="border-b px-3 py-3 bg-gray-200">: Rp. {{ number_format(config('custom.data.biaya.' . $registrasi['student']['majoring_student']), 0, '.', '.') }}</td>
              </tr>
              <!-- Penilaian -->
              <tr>
                <td colspan="2" class="font-bold pt-6">
                    Data Sekolah
                    <small>( <a class="text-sm hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" href="{{ url('/admin/perbaharui/sekolah/' . $registrasi->id_registration) }}">perbaharui</a> )</small>
                </td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3">Sekolah Asal</td>
                <td class="border-b py-3 px-3">: {{ $registrasi['score']['school_score'] }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3 bg-gray-200">No. Peserta UN</td>
                <td class="border-b px-3 py-3 bg-gray-200">: {{ $registrasi['score']['no_peserta_un'] }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3">Nama Siswa</td>
                <td class="border-b py-3 px-3">: {{ $registrasi['student']['name_student'] }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3 bg-gray-200">No. Ijazah</td>
                <td class="border-b px-3 py-3 bg-gray-200">: {{ $registrasi['score']['nomor_ijazah'] }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Tanggal Ijazah</td>
                <td class="border-b px-3 py-3">: {{ $registrasi['score']['tanggal_ijazah'] }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3  bg-gray-200">No. SKHUN</td>
                <td class="border-b py-3 px-3  bg-gray-200">: {{ $registrasi['score']['nomor_skhun'] }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3">Tanggal SKHUN</td>
                <td class="border-b py-3 px-3">: {{ $registrasi['score']['tanggal_skhun'] }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3 bg-gray-200">Jumlah Nilai UN</td>
                <td class="border-b px-3 py-3 bg-gray-200">: {{ curr($registrasi['score']['total_score']) }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3">Rata Rata Nilai UN</td>
                <td class="border-b py-3 px-3">: {{ curr($registrasi['score']['rata_rata_score']) }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3 bg-gray-200">Matematika</td>
                <td class="border-b px-3 py-3 bg-gray-200">: {{ curr($registrasi['score']['mtk_score']) }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3">B. Indonesia</td>
                <td class="border-b py-3 px-3">: {{ curr($registrasi['score']['indo_score']) }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3 bg-gray-200">B. Inggris</td>
                <td class="border-b px-3 py-3 bg-gray-200">: {{ curr($registrasi['score']['inggris_score']) }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">IPA</td>
                <td class="border-b px-3 py-3">: {{ curr($registrasi['score']['ipa_score']) }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3 bg-gray-200">Foto Ijazah</td>
                <td class="border-b px-3 py-3 bg-gray-200">: @if(isset($registrasi['file'][1]) && $registrasi['file'][1]['name_file'] != NULL)
                        Ya (<a class="text-sm hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" target="_blank" href="{{ url('/files/ijazah/' . $registrasi['file'][1]['name_file']) }}">unduh</a>)
                      @else
                        -
                      @endif
                    ( <a class="hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" href="{{ url('/admin/perbaharui/file/ijazah/' . $registrasi->id_registration) }}">perbaharui</a> )
                </td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Foto SKHUN</td>
                <td class="border-b px-3 py-3">: @if(isset($registrasi['file'][2]) && $registrasi['file'][2]['name_file'] != NULL)
                        Ya (<a class="text-sm hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" target="_blank" href="{{ url('/files/skhun/' . $registrasi['file'][2]['name_file']) }}">unduh</a>)
                      @else
                        -
                      @endif
                    ( <a class="hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" href="{{ url('/admin/perbaharui/file/skhun/' . $registrasi->id_registration) }}">perbaharui</a> )
                </td>
              </tr>
            </table>
          </div>
        </div>
    </div>

@endsection
