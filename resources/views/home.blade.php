@extends('templates.base')

@section('title', 'Pendaftaran Siswa Baru - SMKS Teruna Padangsidimpuan')

@section('content')

    <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center mt-10">
        <!--Left Col-->
        <div class="flex flex-col w-full md:w-3/5 justify-center items-start text-center md:text-left mt-20">
            <p class="uppercase tracking-loose w-full">Portal Penerimaan Peserta Didik Baru</p>
            <h1 class="my-4 text-5xl font-bold leading-tight">SMK Swasta Teruna Padangsidimpuan</h1>
            <p class="leading-normal text-2xl mb-8">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>

            <div calss="grid grid-cols-2">
                <div class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg inline-block">
                    <a href="{{ url('/daftar')}}" class="">Daftar Sekarang</a>
                </div>
                <div class="mx-auto lg:mx-0 hover:underline bg-blue-600 text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg inline-block">
                    <a href="{{ url('/masuk') }}" class="">Masuk</a>
                </div>
            </div>

        </div>
        <!--Right Col-->
        <div class="w-full md:w-2/5 py-6 text-center">
            <img class="w-full md:w-4/5 z-50" src="{{ url('/images/logo_new.png') }}">
        </div>

    </div>

@endsection
