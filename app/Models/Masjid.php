<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masjid extends Model
{
    protected $fillable = ['admin_id', 'name', 'address', 'city'];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function hewanKurbans()
    {
        return $this->hasMany(HewanKurban::class, 'masjid_id');
    }

    public function jemaahs()
    {
        return $this->hasMany(Jemaah::class, 'masjid_id');
    }

    public function setorans()
    {
        return $this->hasMany(Setoran::class, 'masjid_id');
    }

    public function pengeluarans()
    {
        return $this->hasMany(Pengeluaran::class, 'masjid_id');
    }
}
