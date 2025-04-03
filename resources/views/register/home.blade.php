@extends('templates.base')

@section('title', 'PPDB - SMKS Teruna Padangsidimpuan')

@section('content')

<div class="xl:grid lg:grid-cols-2 lg:grid lg:grid-cols-2 text-sm pt-6 pb-8 m-6">
    <div class="w-full mb-4 text-black xl:mt-12 lg:mt-12">
        <h3 class="font-bold text-xl mb-3">Alur Pendaftaran Siswa Baru</h3>
        <ol class="list-decimal list-inside">
            <li>Daftarkan akun anda untuk mendapatkan nomor pendaftaran</li>
            <li>Lakukan pengisian untuk keperluan pemberkasan</li>
            <li>Pilih jurusan yang diminati oleh siswa</li>
            <li>Lakukan pembayaran biaya awal sekolah dan lampirkan bukti pembayaran</li>
            <li>Unduh bukti pendaftaran dan dan biodata anda, kemudian serahkan ke pihak sekolah untuk divalidasi ulang
                saat pendaftaran ulang</li>
        </ol>
        <div class="mt-6">
            <i><b>Penting</b> : Dengan melakukan pendaftaran ke pihak sekolah dengan ini dinyatakan bahwa pihak siswa
                dan orang tua telah menyetujui aturan dan tata tertib yang berlaku di SMK Swasta Teruna
                Padangsidipuan.<i>
        </div>
        <div class="mt-6">
            <i><b>Kontak</b> :
                <ul class="list-unstyled list-inside">
                    <li>Aslamiah Rangkuti (+62 813 6198 0199)</li>
                    <li>Asman Efendi Hasibuan (+62 852 7570 9458)</li>
                    <li>Roni Siallagan (+62 823 7033 2416)</li>
                    <li>mail: smksterunapadangsidimpuan.adm@gmail.com</li>
                </ul>
                <i>
        </div>
    </div>
    <div class="w-full max-w-sm mx-auto mt-8">
        @if($message)
        {!! getErrorMessage($message) !!}
        @endif
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ url('/daftar') }}">
            <div class="mb-3 text-center ">
                <h3 class="font-bold text-lg text-gray-700">Daftarkan Akun anda</h3>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Email
                </label>
                <input type="hidden" name="_token" value="{{ $csrf_token }}">
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    name="email" id="name" type="email" placeholder="Email" autofocus="autofocus">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Kata Sandi
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                    name="password" type="password" placeholder="password">
                <!-- <p class="text-red-500 text-xs italic">Please choose a password.</p> -->
            </div>
            <div class="flex items-center justify-between mb-6">
                <button type="submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="button">
                    Daftar
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-green-500 hover:text-green-800"
                    href="{{ url('/masuk') }}">
                    Sudah Terdaftar?
                </a>
            </div>
            <p class="text-center text-gray-700 text-xs">
                &copy;2020 SMK Swasta Teruna Padangsidimpuan
            </p>
        </form>
    </div>
</div>
@endsection