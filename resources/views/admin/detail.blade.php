@extends('templates.admin')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
    <h3 class="text-xl mb-3 font-bold pb-3">Data Pendaftar #{{ $registrasi->id_registration }}</h3>
    <div class=" bg-white p-6 shadow rounded-md">
        <div class="grid grid-cols-2">
          <div class="pr-10">
            <table class="w-full">
              <tr>
                <td colspan="2" class="font-bold">Data Pendaftar</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">No. Pendaftaran</td>
                <td class="border-b px-3 py-3">: {{ $registrasi->id_registration }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 bg-gray-200">Nama Siswa</td>
                <td class="border-b py-3 px-3 bg-gray-200">: {{ $registrasi['student']['name_student'] }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Tanggal Pendaftaran</td>
                <td class="border-b px-3 py-3">: {{ tanggal($registrasi->created_at, true) }} WIB</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 bg-gray-200">Jurusan</td>
                <td class="border-b py-3 px-3 bg-gray-200">: {{ config('custom.data.jurusan.' . $registrasi['student']['majoring_student']) }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Alamat</td>
                <td class="border-b px-3 py-3">: {{ $registrasi['student']['address_student'] }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 bg-gray-200">No. Handphone</td>
                <td class="border-b py-3 px-3 bg-gray-200">: {{ $registrasi['student']['phone_student'] }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Status Pendaftaran</td>
                <td class="border-b px-3 py-3">: {{ $registrasi->status_registration }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 bg-gray-200">Aktivitas Pendaftaran</td>
                <td class="border-b py-3 px-3 bg-gray-200">: {{ $registrasi->current_registration }}</td>
              </tr>
            </table>
          </div>
          <div>

            <table class="w-full">
              <tr>
                <td colspan="2" class="font-bold pt-4">Data Administrasi</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Bukti Pembayaran</td>
                <td class="border-b px-3 py-3">: @if(isset($registrasi['payment']['name_payment']))
                        Ya (<a class="text-sm underline text-blue-700" target="_blank" href="{{ url('/files/pembayaran/' . $registrasi['file'][0]['name_file']) }}">download</a>)
                      @else
                        -
                      @endif
                </td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 bg-gray-200">Bukti Integrasi</td>
                <td class="border-b py-3 px-3 bg-gray-200">: @if(isset($registrasi['payment']['name_payment']))
                        Ya (<a class="text-sm underline text-blue-700" target="_blank" href="{{ url('/files/integrasi/' . $registrasi['file'][1]['name_file']) }}">download</a>)
                      @else
                        -
                      @endif
                </td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Rekening Pengirim</td>
                <td class="border-b px-3 py-3">: {{ $registrasi['payment']['name_payment'] }}</td>
              </tr>
              <tr>
                <td class="border-b py-3 px-3 bg-gray-200">No. Rekening</td>
                <td class="border-b py-3 px-3 bg-gray-200">: {{ $registrasi['payment']['number_payment'] }}</td>
              </tr>
              <tr>
                <td class="border-b px-3 py-3">Nominal Biaya Transfer</td>
                <td class="border-b px-3 py-3">: Rp. {{ number_format(config('custom.data.biaya.' . $registrasi['student']['majoring_student']), 0, '.', '.') }}</td>
              </tr>
            </table>
          </div>
        </div>
    </div>
@endsection
