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
            ],
            'back_url' => url('/siswa/redirector?current=selesai&to=pembayaran')
        ];

        $status = Registration::where('id_registration', $data['registration_id'])->first(['status_registration']);

        if ($status->status_registration == 'tervalidasi') {
            $data['message']['title'] = "Selamat!";
            $data['message']['body'] = "Data anda telah divalidasi oleh panitia pendaftaran.";
            $data['message']['desc'] = "";
        }

        if (!$this->isRecordExists($request, 'integrasi')) {
            $this->generate($request, 'integrasi');
        }

        if (!$this->isRecordExists($request, 'biodata')) {
            $this->generate($request, 'biodata');
        }

        return view('siswa.finish', $data);
    }

    private function isRecordExists(Request $request, $fileType = 'integrasi') {
        if (File::where([
                'type_file' => $fileType,
                'registration_id' => $request->session()->get('registration_id')
            ])->exists()) {

            return true;
        }

        return false;
    }

    private function createOrUpdateFile(Request $request, $fileType)
    {
        $arrayTypeFile = ['integrasi', 'biodata'];
        $fileType = strtolower($fileType);

        if (in_array($fileType, $arrayTypeFile)) {

            $prefix = ($fileType == 'integrasi') ? 'B' : 'I';
            $filename = $prefix . $request->session()->get('registration_id') . '_' . time() . '.pdf';

            // File exists
            if ($this->isRecordExists($request, $fileType)) {
                File::where([
                    'type_file' => $fileType,
                    'registration_id' => $request->session()->get('registration_id')
                ])->update(['name_file' => $filename]);
            } else {
                File::Create([
                    'name_file' => $filename,
                    'type_file' => $fileType,
                    'registration_id' => $request->session()->get('registration_id'),
                    'code_user' => $request->session()->get('code_user')
                ]);
            }

            return [$filename, $fileType];
        }

        return false;
    }

    private function generate(Request $request, $fileType)
    {

        $file = $this->createOrUpdateFile($request, $fileType);

        if ($file[1] == 'integrasi') {
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
            $pdf->setPaper('a4')->save(base_path(config('custom.upload_path') . 'integrasi/' . $file[0]));
        } else {
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
            $pdf->setPaper('a4')->save(base_path(config('custom.upload_path') . 'biodata/' . $file[0]));
        }

        return [$file[0], $file[1]];
    }

    public function download(Request $request)
    {
        $arrayTypeFile = ['integrasi', 'biodata'];
        $fileType = strtolower($request->file);

        if (in_array($fileType, $arrayTypeFile)) {

            $file = $this->generate($request, $fileType);

            return redirect(url('/files/' . $file[1] . '/' . $file[0]));
        }

        return abort(404);

    }

    //
}
