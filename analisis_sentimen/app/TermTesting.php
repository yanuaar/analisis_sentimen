<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermTesting extends Model
{
    protected $table = 'tf_testing';
    protected $primaryKey = 'id_tf_testing';
    protected $fillable = ['kata', 'jum_kata'];
}
