<?php

namespace App\Imports;

use App\Datasets;
use Maatwebsite\Excel\Concerns\ToModel;

class DatasetsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Datasets([
            'ID' => $row[0],
            'datetime' => $row[1],
            'text' => $row[2],
            'usernameTweet' => $row[3], 
            'label' => $row[4],
            'keterangan' => $row[5],
        ]);
    }
}
