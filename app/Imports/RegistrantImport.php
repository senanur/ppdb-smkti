<?php

namespace App\Imports;

use App\EarlyRegister;
use Maatwebsite\Excel\Concerns\ToModel;

class RegistrantImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EarlyRegister([
            'nm_student' => $row[1],
            'sch_student' => $row[2],
            'mjr_student_ft' => $row[3],
            'mjr_student_snd' => $row[4],
            'phn_student' => $row[5],
            'phn_parent' => $row[6],
            'addrs_student' => $row[7],
            'status' => $row[8],
            'status' => $row[9],
            'reg_id' => $row[10],
            'reg_date' => $row[11]
        ]);
    }
}
