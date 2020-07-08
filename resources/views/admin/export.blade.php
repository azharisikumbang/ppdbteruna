@extends('templates.admin')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
    <h3 class="text-xl mb-3 font-bold pb-3">
      Export Data
    </h3>
    <div class="bg-white p-6 shadow rounded-md">
        <table class="w-full mb-4">
            <tr>
                </td>
                <td style="width: 120px;" class="py-3">
                    Tanggal
                </td>
                <td>
                    : {{ date("d/m/Y") }}
                </td>
            </tr>
            <tr>
                <td  class="py-3">
                    Total Data
                </td>
                <td>
                    : {{ $rows }} baris  <span class="italic text-sm"> (*pendaftar tervalidasi)</span>
                </td>
            </tr>
            <tr>
                <td  class="py-3">
                    Diekspor oleh
                </td>
                <td>
                    : {{ $username }}
                </td>
            </tr>
            <tr>
                <td  class="py-3">
                    Format
                </td>
                <td>
                    : xlsx
                </td>
            </tr>
        </table>
        <div class="text-white shadow text-center bg-green-400 rounded px-4 py-2 hover:bg-green-500 w-48">
            <a href="{{ url('/admin/export/excel') }}">Ekspor Sekarang</a>
        </div>
    </div>

@endsection
