<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    const PAS_PHOTO = 'pas-photo';

    protected $fillable = [
        'filename',
        'filetype',
        'filepath',
        'registration_id'
    ];

    public function student()
    {
        return $this->belongsTo(\App\Models\Registration::class, 'registration_id');
    }

}
