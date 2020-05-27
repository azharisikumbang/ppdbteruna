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

            $integrasi = Registration::with([
                'student' => function($query) {
                    $query->select('registration_id', 'name_student', 'birthplace_student', 'birthdate_student', 'phone_student', 'address_student', 'desa_student', 'kecamatan_student', 'kota_student', 'provinsi_student', 'agama_student', 'pos_student', 'majoring_student');
                },
                'parent' => function($query) {
                    $query->select('registration_id', 'nama_ayah', 'nama_ibu', 'nama_wali', 'phone_ayah', 'phone_ibu', 'phone_wali');
                }
            ])->where('id_registration', $request->session()->get('registration_id'))
            ->first(['id_registration', 'created_at']);

            $pdf = PDF::loadView('templates.integrasi', ['data' => $integrasi]);
            $pdf->setPaper('a4')->save(base_path(config('custom.upload_path') . 'integrasi/I' . $filename));

            $biodata = Registration::with([
                    'student',
                    'file' => function($query) {
                        $query->orderBy('created_at', 'asc');
                    },
                    'payment',
                    'parent',
                    'score'
                ])
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
