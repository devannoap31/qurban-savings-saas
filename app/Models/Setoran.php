<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    protected $table = 'setorans';
    
    protected $fillable = [
        'masjid_id', 
        'jemaah_id', 
        'nominal', 
        'tanggal_setor'
    ];

    public function masjid()
    {
        return $this->belongsTo(Masjid::class, 'masjid_id');
    }

    public function jemaah()
    {
        return $this->belongsTo(Jemaah::class, 'jemaah_id');
    }
}
