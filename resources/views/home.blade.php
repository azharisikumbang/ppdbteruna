@extends('templates.base')

@section('title', 'Pendaftaran Siswa Baru - SMKS Teruna Padangsidimpuan')

@section('content')

    <div class="flex flex-wrap flex-col-reverse sm:flex-col-reverse md:flex-col-reverse lg:flex-row xl:flex-row items-center p-4">
        <!--Left Col-->
        <div class="flex flex-col w-full md:w-3/5 justify-center text-center md:text-left md:mt-20 xl:mt-20 lg:mt-20">
            <p class="uppercase tracking-loose w-full">Portal Penerimaan Peserta Didik Baru</p>
            <h1 class="my-4 w-full text-2xl xl:text-5xl lg:text-5xl font-bold leading-tight">SMK Swasta Teruna Padangsidimpuan</h1>
            <p class="leading-normal text-xl mb-8">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
            <div calss="flex justify-center flex-row">
                <div class="lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg block sm:inline-block md:inline-block">
                    <a href="{{ url('/daftar')}}" class="">Daftar Sekarang</a>
                </div>
                <div class="lg:mx-0 hover:underline bg-blue-600 text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg block sm:inline-block md:inline-block">
                    <a href="{{ url('/masuk') }}" class="">Masuk</a>
                </div>
            </div>

        </div>
        <!--Right Col-->
        <div class="flex w-full md:w-2/5 py-6 justify-center xl:justify-end lg:justify-end">
            <img class="w-1/4 sm:w-1/4 md:w-3/4 lg:w-3/4 xl:3/4 z-50" src="{{ url('/images/logo_new.png') }}">
        </div>

    </div>

@endsection
