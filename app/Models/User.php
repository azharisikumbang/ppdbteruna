<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements AuthenticatableContract, AuthorizableContract
{
    const ROLE_SISWA = 'student';

    const ROLE_ADMIN = 'admin';

    const ROLE_SUPER_ADMIN = 'super-admin';

    protected $fillable = [
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function student()
    {
        return $this->belongsTo(\App\Models\Registration::class, 'registration_id');
    }

    public function registration(): HasOne
    {
        return $this->hasOne(Registration::class, 'current_user_id');
    }
}
