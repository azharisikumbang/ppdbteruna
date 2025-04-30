<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreviousSchool extends Model
{
    protected $fillable = [
        'school_name',
        'certificate_number',
        'certificate_date',
        'skhun_number',
        'student_id'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
