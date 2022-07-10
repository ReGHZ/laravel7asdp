<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tembusan extends Model
{

    protected $fillable = [
        'user_id',
        'persetujuan_cuti_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function persetujuan_cuti()
    {
        return $this->belongsTo(PersetujuanCuti::class);
    }
}
