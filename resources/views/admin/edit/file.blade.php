@extends('templates.admin')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')
    <h3 class="text-xl mb-3 font-bold pb-3">
        Perbaharui {{ ucfirst($data->type_file) }} #{{ $data->registration_id }}
        <small>(<a class="text-sm hover:border-gray-900 border-dotted border-b-2 border-gray-400 text-gray-700" href="{{ url('/admin/detail/' . $data->registration_id ) }}">kembali</a>)</small>

    </h3>
    <div class=" bg-white p-6 shadow rounded-md">
      <div class="pr-10">
        <!-- Form -->
        <div class="text-gray-700">
            @if(isset($message))
                {!! getErrorMessage($message) !!}
            @endif
            <form class="w-full" method="POST" action="{{ url('/admin/perbaharui/file/' . $data->type_file . '/' . $data->registration_id) }}" enctype="multipart/form-data">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="firstname">
                        Pas Photo ( 3 X 4 / Warna ) max 2mb baru
                      </label>
                      <input type="hidden" name="_token" value="{{ $csrf_token }}">
                      <input class="appearance-none block w-full text-gray-700 py-3 mb-3 leading-tight" name="file" type="file">
                    </div>
                    <div class="w-full xl:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                        Preview File Lama
                      </label>
                      <div class="w-full">
                        @if($data->name_file != null)
                            @if(strpos($data->name_file, ".pdf"))
                                <a href="{{ url('files/' . $data->type_file . '/' . $data->name_file) }}" target="_blank">Preview</a>
                            @else
                                <img src="{{ url('files/' . $data->type_file . '/' . $data->name_file) }}" class="h-48">
                                <a href="{{ url('files/' . $data->type_file . '/' . $data->name_file) }}" target="_blank">Full Preview</a>
                            @endif
                            <br>
                            filename : {{ $data->name_file }}
                        @else
                            file not found.
                        @endif
                      </div>
                    </div>
                </div>
                <div class="flex -mx-3 mt-6 xl:mb-6">
                    <div class="w-full md:w-32 xl:w-32 xg:w-32 text-white shadow text-center bg-green-400 rounded px-4 py-2 m-2 hover:bg-green-500">
                        <button type="submit">Perbaharui</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>

@endsection
