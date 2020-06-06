<?php
namespace App\Exports;

use App\Models\Registration;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CompleteDataExport implements FromView
{
    public function view() : View
    {
        $data = Registration::with('student', 'parent', 'score')->get();
        $tahun = (isset($data[0]->created_at)) ? date("Y", strtotime($data[0]->created_at)) : date("Y");
        return view('templates.excel', ['data' => $data, 'tahun' => $tahun]);
    }
}
