<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\File;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade as PDF;

class SelesaiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $data = [
            'username' => $request->session()->get('username'),
            'registration_id' => $request->session()->get('registration_id')
        ];

        $file = File::where('type_file', 'integrasi')
            ->where('registration_id', $data['registration_id'])
            ->first();

        $filename = (isset($file->name_file)) ? $file->name_file : '';

        if (!$file) {
            $filename = "I" . $data['registration_id'] . '_' . time() . '.pdf';

            File::Create([
                'name_file' => $filename,
                'type_file' => 'integrasi',
                'registration_id' => $data['registration_id'],
                'code_user' => $request->session()->get('code_user')
            ]);

            $data['student'] = Student::where('registration_id', $data['registration_id'])->first();
            $data['payment'] = Payment::where('registration_id', $data['registration_id'])->first();
            $data['tanggal'] = tanggal($data['student']->created_at);
            $data['jurusan'] = config('custom.data.jurusan.'. $data['student']->majoring_student);
            $data['biaya'] = config('custom.data.biaya.'. $data['student']->majoring_student);

            $pdf = PDF::loadView('templates.integrasi', $data);
            $pdf->setPaper('a4')->save(base_path('public/files/integrasi/' . $filename));

        }

        return view('siswa.finish', $data);
    }

    public function download(Request $request)
    {

        $file = File::where('type_file', 'integrasi')
            ->where('registration_id', $request->session()->get('registration_id'))
            ->first('name_file');

        return redirect(url('/files/integrasi/' . $file->name_file));

    }

    //
}
