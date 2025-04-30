<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    const STEP_AWAL = 0;

    const STEP_PEMBERKASAN = 1;

    const STEP_DATA_SEKOLAH = 2;

    const STEP_DATA_ORANGTUA = 3;

    protected $fillable = [
        'registration_status',
        'registration_current_step',
        'validated_by',
        'current_user_id',
        'registration_code',
        'kode_jurusan_diambil',
        'nama_jurusan_diambil'
    ];


    public function student()
    {
        return $this->hasOne(
            \App\Models\Student::class,
            'registration_id'
        );
    }

    public function file()
    {
        return $this->hasMany(
            \App\Models\File::class,
            'registration_id'
        );
    }

    public function payment()
    {
        return $this->hasOne(
            \App\Models\Payment::class,
            'registration_id'
        );
    }

    public function user()
    {
        return $this->hasOne(
            \App\Models\User::class,
            'code_user',
            'validate_by'
        );
    }

    public function parent()
    {
        return $this->hasOne(
            \App\Models\ParentStudent::class,
            'registration_id'
        );
    }

    public function score()
    {
        return $this->hasOne(
            \App\Models\Score::class,
            'registration_id'
        );
    }

    public function delete()
    {
        $this->student()->delete();
        $this->file()->delete();
        $this->payment()->delete();
        $this->user()->delete();
        $this->parent()->delete();
        $this->score()->delete();

        return parent::delete();
    }

}
