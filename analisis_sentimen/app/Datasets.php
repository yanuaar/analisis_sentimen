<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datasets extends Model
{
    protected $table = 'datasets';
    protected $primaryKey = 'ID';
    protected $fillable = ['ID','datetime','text','usernameTweet','label','keterangan'];
}
