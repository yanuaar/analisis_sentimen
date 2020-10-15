<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preprocessing extends Model
{
    protected $table = 'preprocessing';
    protected $primaryKey = 'id_preprocessing';
    protected $fillable = ['id_datasets','cleaning','label','keterangan'];
}
