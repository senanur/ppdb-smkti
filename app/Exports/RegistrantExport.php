<?php

namespace App\Exports;

use App\EarlyRegister;
use Maatwebsite\Excel\Concerns\FromCollection;

class RegistrantExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EarlyRegister::all();
    }
}
