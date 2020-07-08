<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'id_registration', 'status_registration', 'current_registration', 'validate_by', 'code_user'
    ];

    protected $primaryKey = 'id_registration';

    public $incrementing = false;


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
