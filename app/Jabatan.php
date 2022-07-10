<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{

    protected $fillable = ['nama_jabatan', 'deskripsi'];
}
