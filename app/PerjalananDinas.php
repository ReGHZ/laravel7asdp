<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjalananDinas extends Model
{

    use \Znck\Eloquent\Traits\BelongsToThrough;

    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        // 'user_id',
        'nomor_surat',
        'tanggal_surat',
        'perihal',
        'pembebanan_biaya',
        'tanggal_keberangkatan',
        'tanggal_kembali',
        'lama_hari',
        'keterangan',
        'jenis_kendaraan',
        'tujuan',
        'biaya_kas',
        'biaya_ybs',
        'disetujui_di',
        'status',
    ];


    public function pengikut()
    {
        return $this->hasMany(Pengikut::class);
    }

    public function rab()
    {
        return $this->hasOne(Rab::class);
    }

    public function biayaLain()
    {
        return $this->hasMany(BiayaLain::class);
    }
}
