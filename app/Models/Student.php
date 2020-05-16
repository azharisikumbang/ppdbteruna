<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name_student', 'registration_id', 'address_student', 'phone_student', 'majoring_student', 'code_user', 'status_student', 'parent_student', 'agama_student', 'gender_student', 'nik_student', 'desa_student', 'kecamatan_student', 'kota_student', 'provinsi_student', 'pos_student', 'rt_rw_student', 'transport_student', 'distance_student', 'home_student', 'accommodation_student', 'blood_student', 'siblings_student', 'child_order_student',
    ];

    protected $primaryKey = 'id_student';

    public function student()
    {
        return $this->belongsToMany(\App\Models\Registration::class, 'registration_id');
    }


}
