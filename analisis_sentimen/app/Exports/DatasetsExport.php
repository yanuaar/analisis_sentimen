<?php

namespace App\Exports;

use App\Datasets;
use Maatwebsite\Excel\Concerns\FromCollection;

class DatasetsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Datasets::all();
    }
}
