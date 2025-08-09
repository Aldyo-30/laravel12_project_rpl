<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penduduk extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'total',
        'kepala_keluarga',
        'laki_laki',
        'perempuan',
        'desa',
        'dusun_1',
        'dusun_2',
        'dusun_3',
        'dusun_4',
        'dusun_5',
    ];
}
