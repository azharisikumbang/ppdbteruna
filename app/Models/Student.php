<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    protected $fillable = [
        "nama_lengkap",
        "nik",
        "jenis_kelamin",
        "tempat_lahir",
        "tanggal_lahir",
        "status_orangtua",
        "status_anak",
        "urutan_dalam_keluarga",
        "jumlah_bersaudara",
        "agama",
        "golongan_darah",
        "nomor_handphone",
        "alamat",
        "rt",
        "rw",
        "desa",
        "kecamatan",
        "kota",
        "provinsi",
        "kode_pos",
        "transportasi",
        "jarak_rumah_sekolah",
        "jenis_bantuan_pemerintah",
        "kepemilikan_rumah",
        "photo_id",
        "registration_id",
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function pasPhoto(): HasOne
    {
        return $this
            ->hasOne(File::class, 'id', 'photo_id');
    }


}
