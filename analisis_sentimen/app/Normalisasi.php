<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Normalisasi extends Model
{
    protected $table = 'tb_normalisasi';
    protected $fillable = ['kata_gaul', 'normalisasi'];
}
