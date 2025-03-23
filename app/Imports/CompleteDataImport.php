<?php
namespace App\Imports;

use App\Models\Registration;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class CompleteDataImport implements ToModel
{
    public function model(array $row)
    {
        return new Registration([
            'name' => $row[0],
            'email' => $row[1],
            'password' => Hash::make($row[2]),
        ]);
    }
}
