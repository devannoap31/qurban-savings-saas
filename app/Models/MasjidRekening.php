<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasjidRekening extends Model
{
    protected $fillable = ['masjid_id', 'platform', 'nomor_rekening', 'atas_nama'];

    public function masjid()
    {
        return $this->belongsTo(Masjid::class, 'masjid_id');
    }
}
