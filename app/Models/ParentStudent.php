<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentStudent extends Model
{
    protected $table = 'parents';

    protected $fillable = [
        'registration_id',
        'nama_ayah',
        'tempat_lahir_ayah',
        'tanggal_lahir_ayah',
        'alamat_ayah',
        'penghasilan_ayah',
        'pekerjaan_ayah',
        'agama_ayah',
        'nama_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'alamat_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'agama_ibu',
        'nama_wali',
        'tempat_lahir_wali',
        'tanggal_lahir_wali',
        'pekerjaan_wali',
        'penghasilan_wali',
        'agama_wali',
        'phone_ayah',
        'phone_ibu',
        'phone_wali',
        'pendidikan_ayah',
        'pendidikan_ibu',
        'pendidikan_wali'
   ];

    protected $primaryKey = 'id_parents';

    public function student()
    {
        return $this->belongsTo(\App\Models\Registration::class, 'id_registration');
    }

}
