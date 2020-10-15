<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextAnalysis extends Model
{
    protected $table = 'text_analysis';
    protected $fillable = ['text_input'];
}
