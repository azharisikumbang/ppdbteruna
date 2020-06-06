<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CompleteDataExport;
use App\Models\Registration;


class ExportController extends Controller
{

    private $title = 'DATA-PESERTA-DIDIK-BARU-PPDB';
    private $format = 'xlsx';

    public function index(Request $request)
    {
        $data = [
            'username' => $request->session()->get('username'),
            'role' => $request->session()->get('role'),
            'csrf_token' => $request->session()->get('_token'),
            'rows' => Registration::all()->count()
        ];

        return view('admin.export', $data);
    }

    public function toExcel(Request $request)
    {
        $download_year = date('Y');
        $download_signature = date("dmY");
        return Excel::download(new CompleteDataExport, sprintf("%s-%s-%s_%s.%s", $this->title, $download_year, ($download_year + 1), $download_signature, $this->format));
    }
    //
}
