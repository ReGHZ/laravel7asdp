<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        //id
        'perjalanan_dinas_id',
        'pengikut_id',
        //tiket perjalanan dinas
        'maskapai',
        'harga_tiket',
        'tempat_berangkat',
        'tempat_tujuan',
        'charge',
        'jumlah_harga_tiket',
        //biaya harian
        'biaya_harian',
        'jumlah_biaya_harian',
        //biaya penginapan
        'lama_hari_penginap',
        'biaya_penginapan',
        'jumlah_biaya_penginapan',
        //total
        'total',
        'jumlah_biaya_lain',
    ];

    public function perjalananDinas()
    {
        return $this->belongsTo(PerjalananDinas::class);
    }

    public function pengikut()
    {
        return $this->belongsTo(Pengikut::class);
    }

    public function biayaLain()
    {
        return $this->hasMany(BiayaLain::class);
    }
}
