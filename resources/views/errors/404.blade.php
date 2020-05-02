@extends('templates.base')

@section('title', 'Pendaftaran Siswa Baru - SMKS Teruna Padangsidimpuan')

@section('content')

    <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center mt-10">
        <!--Left Col-->
        <div class="flex flex-col w-full md:w-3/5 justify-center items-start text-center md:text-left mt-20">
            <p class="uppercase tracking-loose w-full">Ooups! Terjadi Kesalahan !</p>
            <h1 class="my-4 text-5xl font-bold leading-tight">404 Page Not Found</h1>
            <p class="leading-normal text-2xl mb-8">Halaman yang anda tuju tidak terdapat di layanan kami. Mohon periksa kembali tujuan anda.</p>

            <div class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg inline-block">
                <a href="{{ url('/')}}" class="">Kembali</a>
            </div>

        </div>
        <!--Right Col-->
        <div class="w-full md:w-2/5 py-6 text-center">
            <img class="w-full md:w-4/5 z-50" src="{{ url('/images/logo_new.png') }}">
        </div>

    </div>

@endsection
