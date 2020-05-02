<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $fillable = [
        'email_user', 'code_user', 'role_user', 'password_user', 'username_user'
    ];

    protected $hidden = [
        'password_user'
    ];

    protected $primaryKey = 'id_user';

    public $incrementing = false;

    public function student()
    {
        return $this->hasMany(\App\Models\Registration::class, 'id_registration');
    }
}
