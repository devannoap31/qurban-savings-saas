<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HewanKurban extends Model
{
    protected $table = 'hewan_kurbans';
    
    protected $fillable = [
        'masjid_id', 
        'jenis_hewan', 
        'deskripsi', 
        'harga_total', 
        'kapasitas_slot', 
        'target_per_slot', 
        'slot_terisi'
    ];

    public function masjid()
    {
        return $this->belongsTo(Masjid::class, 'masjid_id');
    }

    public function jemaahs()
    {
        return $this->hasMany(Jemaah::class, 'hewan_kurban_id');
    }

    public function pengeluarans()
    {
        return $this->hasMany(Pengeluaran::class, 'hewan_kurban_id');
    }
}
