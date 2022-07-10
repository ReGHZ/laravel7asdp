<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{

    protected $fillable = ['nama_divisi', 'deskripsi'];
}
