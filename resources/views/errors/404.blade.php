@extends('templates.base')

@section('title', 'Pendaftaran Siswa Baru - SMKS Teruna Padangsidimpuan')

@section('content')

    <div class="flex flex-wrap flex-col-reverse sm:flex-col-reverse md:flex-col-reverse lg:flex-row xl:flex-row items-center p-4">
        <!--Left Col-->
        <div class="flex flex-col w-full md:w-3/5 justify-center text-center md:text-left md:mt-20 xl:mt-20 lg:mt-20">
            <p class="uppercase tracking-loose w-full">Ooups! Terjadi Kesalahan !</p>
            <h1 class="my-4 text-5xl font-bold leading-tight">404 Page Not Found</h1>
            <p class="leading-normal text-2xl mb-8">Halaman yang anda tuju tidak terdapat di layanan kami. Mohon periksa kembali tujuan anda.</p>

            <div class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg inline-block">
                <a href="{{ url('/')}}" class="">Kembali</a>
            </div>

        </div>
        <!--Right Col-->
        <div class="flex w-full md:w-2/5 py-6 justify-center xl:justify-end lg:justify-end">
            <img class="w-1/4 sm:w-1/4 md:w-3/4 lg:w-3/4 xl:3/4 z-50" src="{{ url('/images/logo_new.png') }}">
        </div>

    </div>

@endsection
