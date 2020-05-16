<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'registration_id', 'name_payment', 'number_payment', 'code_user', 'bank_payment'
    ];

    protected $primaryKey = 'id_payment';

    public function regis()
    {
        return $this->belongsTo(\App\Models\Registration::class, 'registration_id');
    }

}
