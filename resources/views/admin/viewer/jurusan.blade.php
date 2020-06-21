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
                   <th class="px-4 py-4 bg-gray-200 border-2">Jenis Kelamin</th>
                   <th class="px-4 py-4 bg-gray-200 border-2">Tanggal Pendaftaran</th>
               </tr>
           </thead>
           <tbody>
            @isset($students)
                @php
                    $no = 1;
                @endphp
                @foreach($students as $student)
                <tr>
                    <td class="px-4 py-2 border-2 text-center">{{
                        (isset($_GET['page'])) ? (($_GET['page'] - 1) * 10) + $no++ : $no++
                     }}</td>
                    <td class="px-4 py-2 border-2">
                        <a class="hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" href="{{ url('/admin/detail/' . $student->registration_id)  }}">{{ $student->registration_id }}</a>
                    </td>
                    <td class="px-4 py-2 border-2">{{ $student->name_student }}</td>
                    <td class="px-4 py-2 border-2">
                      {{ gender($student->gender_student) }}
                    </td>
                    <td class="px-4 py-2 border-2 text-center">
                      {{ tanggal($student->created_at, true) }}
                    </td>
                </tr>
                @endforeach
            @endisset
           </tbody>
       </table>

       <div class="mt-4">
           @if ($students->hasPages())
            <div class="flex items-center">
                {{-- Previous Page Link --}}
                @if ($students->onFirstPage())
                    <span class="rounded-l rounded-sm border border-brand-light px-3 py-2 cursor-not-allowed no-underline">&laquo;</span>
                @else
                    <a
                        class="rounded-l rounded-sm border-t border-b border-l border-brand-light px-3 py-2 text-brand-dark hover:bg-brand-light no-underline"
                        href="{{ $students->previousPageUrl() }}{{ (isset($_GET['q'])) ? '&q=' . $_GET['q'] : '' }}"
                        rel="prev"
                    >
                        &laquo;
                    </a>
                @endif

                {{-- Next Page Link --}}
                @if ($students->hasMorePages())
                    <a class="rounded-r rounded-sm border border-brand-light px-3 py-2 hover:bg-brand-light text-brand-dark no-underline" href="{{ $students->nextPageUrl() }}{{ (isset($_GET['q'])) ? '&q=' . $_GET['q'] : '' }}" rel="next">&raquo;</a>
                @else
                    <span class="rounded-r rounded-sm border border-brand-light px-3 py-2 hover:bg-brand-light text-brand-dark no-underline cursor-not-allowed">&raquo;</span>
                @endif

                <span class="ml-2">
                    Page {{ $students->currentPage() }} of {{ round($students->total() / $students->perPage()) }}
                </span>
            </div>
        @endif
       </div>
    </div>
@endsection
