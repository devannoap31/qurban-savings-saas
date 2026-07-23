<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jemaah extends Model
{
    protected $table = 'jemaahs';
    
    protected $fillable = [
        'user_id', 
        'masjid_id', 
        'hewan_kurban_id', 
        'nama_jemaah', 
        'total_saldo', 
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function masjid()
    {
        return $this->belongsTo(Masjid::class, 'masjid_id');
    }

    public function hewanKurban()
    {
        return $this->belongsTo(HewanKurban::class, 'hewan_kurban_id');
    }

    public function setorans()
    {
        return $this->hasMany(Setoran::class, 'jemaah_id');
    }
}
