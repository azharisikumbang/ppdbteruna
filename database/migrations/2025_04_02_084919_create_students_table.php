<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nik', 24);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('status_orangtua');
            $table->string('status_anak');
            $table->unsignedTinyInteger('urutan_dalam_keluarga')->default(1);
            $table->unsignedTinyInteger('jumlah_bersaudara');
            $table->string('agama');
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O', '-']);
            $table->string('nomor_handphone')->nullable();
            $table->text('alamat');
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('kode_pos')->nullable();
            $table->string('transportasi')->nullable();
            $table->unsignedFloat('jarak_rumah_sekolah')->default(1.00);
            $table->string('jenis_bantuan_pemerintah')->nullable();
            $table->string('kepemilikan_rumah')->nullable();

            $table->foreignId('registration_id')->constrained('registrations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
