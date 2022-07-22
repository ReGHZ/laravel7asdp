<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiayaLain extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        //id
        'rab_id',
        //biaya lain
        'qty',
        'jenis',
        'biaya_lain',
    ];

    public function rab()
    {
        return $this->belongsTo(Rab::class);
    }
}
