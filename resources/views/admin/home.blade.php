@extends('templates.admin')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
    <div>
      <div class="mb-6 bg-white p-6 shadow rounded-md">
        <h3 class="text-xl">Aktivitas Portal PPDB</h3>
        <ul class="ml-4 mt-2 h-64 overflow-y-scroll">
           @foreach($registrasi['data'] as $key => $value)
            <li class="text-gray-700 text text-{{ $logger["{$value->status_registration}"][1] }}-700">
              * [{{ date("H:i", strtotime($value->updated_at)) }}]
              <strong><i>#<a class="hover:underline" href="{{ url('/admin/detail/' . $value->id_registration ) }}">{{ $value->id_registration }}</a></i></strong>
              {{ $logger["{$value->status_registration}"][0] }}
              <?= ($value->status_registration == 'tervalidasi') ? $value['user']['username_user'] : '' ?>
            </li>
           @endforeach
        </ul>
      </div>
      <div class="mb-6 bg-white p-6 shadow rounded-md">
        <table class="table-auto w-full">
           <thead>
               <tr>
                   <th class="px-4 py-4 bg-gray-200 border-2">Jurusan</th>
                   <th class="px-4 py-4 bg-gray-200 border-2">Total Pendaftar*</th>
               </tr>
           </thead>
           <tbody>
            @isset($registrasi['jurusan'])
                @foreach($registrasi['jurusan'] as $key => $value)
                <tr>
                    <td class="px-4 py-2 border-2">{{ config('custom.data.jurusan.' . $key) . ' (' . $key . ')'}}</td>
                    <td class="px-4 py-2 border-2 text-center">{{ $value->counter }}</td>
                </tr>
                @endforeach
                <tr>
                    <td class="px-4 py-2 border-2 text-right font-bold">Total Pendaftar</td>
                    <td class="px-4 py-2 border-2 text-center bg-gray-200"><?= isset($registrasi['semua']->counter) ? $registrasi['semua']->counter : '0' ?></td>
                </tr>
            @endisset
           </tbody>
       </table>
       <small class="italic text-gray-700">* total berdasarkan akun yang terdaftar, bukan pendaftar yang telah tervalidasi</small>
      </div>

    </div>
@endsection
