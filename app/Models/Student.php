<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name_student', 'registration_id', 'address_student', 'phone_student', 'majoring_student', 'code_user'
    ];

    protected $primaryKey = 'id_student';

    public function student()
    {
        return $this->belongsToMany(\App\Models\Registration::class, 'registration_id');
    }


}
