@extends('templates.admin')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
    <div class=" bg-white p-6 shadow rounded-md">
       <table class="table-auto w-full">
           <thead>
               <tr>
                   <th class="px-4 py-4 bg-gray-200 border-2 w-10">No</th>
                   <th class="px-4 py-4 bg-gray-200 border-2">No. Pendaftaran</th>
                   <th class="px-4 py-4 bg-gray-200 border-2">Nama</th>
                   <th class="px-4 py-4 bg-gray-200 border-2">No. Rekening</th>
                   <th class="px-4 py-4 bg-gray-200 border-2">Status</th>
               </tr>
           </thead>
           <tbody>
            @isset($registrasi)
                @php
                    $no = 1;
                @endphp
                @foreach($registrasi as $regis)
                <tr>
                    <td class="px-4 py-2 border-2 text-center">{{
                        (isset($_GET['page'])) ? (($_GET['page'] - 1) * 10) + $no++ : $no++
                     }}</td>
                    <td class="px-4 py-2 border-2">
                        <a class="hover:underline" href="{{ url('/admin/detail/' . $regis->id_registration)  }}">{{ $regis->id_registration }}</a>
                    </td>
                    <td class="px-4 py-2 border-2">{{ $regis['student']['name_student'] }}</td>
                    <td class="px-4 py-2 border-2">
                        @if(isset($regis['payment']['number_payment']))
                            <a class="hover:underline" href='{{ url("/files/pembayaran/{$regis["file"][0]["name_file"]}") }}' target="_blank">{{ $regis['payment']['number_payment'] }}</a>
                        @else
                        -
                        @endif
                    </td>
                    <td class="px-4 py-2 border-2 text-center">
                        @if($validasi)
                        <button onclick="validate(this)" data-status='tervalidasi' data-regid="{{ $regis->id_registration }}" data-validator="{{ $code_user }}" type="button" class="bg-orange-500 px-4 py-1 text-white rounded shadow">validasi</button>
                        <button onclick="validate(this)" data-status='gagal' data-regid="{{ $regis->id_registration }}" data-validator="{{ $code_user }}" type="button" class="bg-gray-500 px-4 py-1 text-white rounded shadow">batalkan</button>
                        @else
                            <button class="px-4 py-1 text-white rounded shadow bg-{{ $html['color']["{$regis->status_registration}"] }}-500">
                                {{ $regis->status_registration }}
                            </button>
                            @if($regis->status_registration == 'menunggu')
                                <button onclick="validate(this)" data-status='tervalidasi' data-regid="{{ $regis->id_registration }}" title="Klik untuk memvalidasi" data-validator="{{ $code_user }}" type="button" class="bg-orange-500 px-4 py-1 hover:bg-white hover:text-orange-500 text-white rounded shadow">validasi ?</button>
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            @endisset
           </tbody>
       </table>

       <div class="mt-4">
           @if ($registrasi->hasPages())
            <div class="flex items-center">
                {{-- Previous Page Link --}}
                @if ($registrasi->onFirstPage())
                    <span class="rounded-l rounded-sm border border-brand-light px-3 py-2 cursor-not-allowed no-underline">&laquo;</span>
                @else
                    <a
                        class="rounded-l rounded-sm border-t border-b border-l border-brand-light px-3 py-2 text-brand-dark hover:bg-brand-light no-underline"
                        href="{{ $registrasi->previousPageUrl() }}{{ (isset($_GET['q'])) ? '&q=' . $_GET['q'] : '' }}"
                        rel="prev"
                    >
                        &laquo;
                    </a>
                @endif

                {{-- Next Page Link --}}
                @if ($registrasi->hasMorePages())
                    <a class="rounded-r rounded-sm border border-brand-light px-3 py-2 hover:bg-brand-light text-brand-dark no-underline" href="{{ $registrasi->nextPageUrl() }}{{ (isset($_GET['q'])) ? '&q=' . $_GET['q'] : '' }}" rel="next">&raquo;</a>
                @else
                    <span class="rounded-r rounded-sm border border-brand-light px-3 py-2 hover:bg-brand-light text-brand-dark no-underline cursor-not-allowed">&raquo;</span>
                @endif

                <span class="ml-2">
                    Page {{ $registrasi->currentPage() }} of {{ round($registrasi->total() / $registrasi->perPage()) }}
                </span>
            </div>
        @endif
       </div>
    </div>
@endsection
