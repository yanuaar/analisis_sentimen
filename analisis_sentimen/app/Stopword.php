<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stopword extends Model
{
    protected $table = 'tb_stopword';
    protected $fillable = ['kata'];
}
