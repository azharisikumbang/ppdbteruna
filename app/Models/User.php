<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements AuthenticatableContract, AuthorizableContract
{
    protected $fillable = [
        'email_user',
        'code_user',
        'role_user',
        'password_user',
        'username_user'
    ];

    protected $hidden = [
        'password_user'
    ];

    protected $primaryKey = 'id_user';

    public $incrementing = false;

    public function student()
    {
        return $this->belongsTo(\App\Models\Registration::class, 'registration_id');
    }
}
