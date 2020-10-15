<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testing extends Model
{
    protected $table = 'testing';
    protected $primaryKey = 'id_testing';
    protected $fillable = ['id_preprocessing', 'id_datasets', 'hsl_pos'];
    // protected $fillable = ['hasil_seleksi'];
}
