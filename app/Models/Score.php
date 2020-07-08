<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
       'school_score', 'mtk_score', 'indo_score', 'inggris_score', 'ipa_score', 'registration_id', 'no_peserta_un', 'nomor_ijazah', 'tanggal_ijazah', 'nomor_skhun', 'tanggal_skhun', 'nisn_score'

   ];

    protected $primaryKey = 'id_scores';

    public function registration()
    {
        return $this->belongsTo(\App\Models\Registration::class, 'id_registration');
    }

}
