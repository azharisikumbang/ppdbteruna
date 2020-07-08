<?php
namespace App\Imports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\ToModel;

class CompleteDataImport extends ToModel
{
    public function model(array $row)
    {
        return new Registration([
           'name'     => $row[0],
           'email'    => $row[1],
           'password' => Hash::make($row[2]),
        ]);
    }
}
