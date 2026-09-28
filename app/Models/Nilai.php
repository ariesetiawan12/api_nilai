<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = [
        'nim',
        'nama',
        'mata_kuliah',
        'nilai',
        'keterangan',
        'grade'
    ];
}