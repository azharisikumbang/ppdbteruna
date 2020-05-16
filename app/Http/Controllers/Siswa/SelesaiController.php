<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\File;
use App\Models\Payment;
use App\Models\Registration;
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
            'registration_id' => $request->session()->get('registration_id'),
            'message' => [
                'title' => 'Terima Kasih!',
                'body' => 'Data anda sedang kami diproses.',
                'desc' => 'Anda juga bisa melakukan pengecekan berkala pada halaman web ini untuk mengetahui perkembangan validasi data anda.'
            ]
        ];

        $status = Registration::where('id_registration', $data['registration_id'])->first(['status_registration']);

        if ($status->status_registration == 'tervalidasi') {
            $data['message']['title'] = "Selamat!";
            $data['message']['body'] = "Data anda telah divalidasi oleh panitia pendaftaran.";
            $data['message']['desc'] = "";
        }

        $file = File::where('type_file', 'integrasi')
            ->where('registration_id', $data['registration_id'])
            ->first();

        $filename = (isset($file->name_file)) ? $file->name_file : '';

        if (!$file) {
            $filename = $data['registration_id'] . '_' . time() . '.pdf';

            File::Create([
                'name_file' => "I" . $filename,
                'type_file' => 'integrasi',
                'registration_id' => $data['registration_id'],
                'code_user' => $request->session()->get('code_user')
            ]);

            File::Create([
                'name_file' => "B" . $filename,
                'type_file' => 'biodata',
                'registration_id' => $data['registration_id'],
                'code_user' => $request->session()->get('code_user')
            ]);

            $data['student'] = Student::where('registration_id', $data['registration_id'])->first();

            $data['payment'] = Payment::where('registration_id', $data['registration_id'])->first();
            $data['tanggal'] = tanggal($data['student']->created_at);

            $data['jurusan'] = config('custom.data.jurusan.'. $data['student']->majoring_student);
            $data['biaya'] = config('custom.data.biaya.'. $data['student']->majoring_student);

            $pdf = PDF::loadView('templates.integrasi', $data);
            $pdf->setPaper('a4')->save(base_path(config('custom.upload_path') . 'integrasi/I' . $filename));

            $biodata = Registration::with(['student', 'file', 'payment', 'parent', 'score'])
                ->where('id_registration', $request->session()->get('registration_id'))
                ->first();

            $pdf = PDF::loadView('templates.biodata', ['data' => $biodata]);
            $pdf->setPaper('a4')->save(base_path(config('custom.upload_path') . 'biodata/B' . $filename));

        }

        return view('siswa.finish', $data);
    }

    public function download(Request $request)
    {

        if ($request->file && ($request->file == 'biodata' || $request->file == 'integrasi')) {
            $file = File::where('type_file', $request->file)
                ->where('registration_id', $request->session()->get('registration_id'))
                ->first('name_file');

            return redirect(url('/files/' . $request->file . '/' . $file->name_file));
        }

        abort(404);

    }

    //
}
