<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
       'name_file', 'type_file', 'registration_id', 'code_user'
   ];

    protected $primaryKey = 'id_files';

    public function student()
    {
        return $this->belongsTo(\App\Models\Registration::class, 'id_registration');
    }

}
