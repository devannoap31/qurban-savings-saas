<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluarans';
    
    protected $fillable = [
        'masjid_id', 
        'hewan_kurban_id', 
        'nama_pengeluaran', 
        'nominal', 
        'tanggal'
    ];

    public function masjid()
    {
        return $this->belongsTo(Masjid::class, 'masjid_id');
    }

    public function hewanKurban()
    {
        return $this->belongsTo(HewanKurban::class, 'hewan_kurban_id');
    }
}
