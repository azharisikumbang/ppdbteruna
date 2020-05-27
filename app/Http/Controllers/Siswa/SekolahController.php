<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Student;
use App\Models\Score;
use App\Models\File;

class SekolahController extends Controller
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
            'jurusan' => config('custom.data.jurusan'),
            'message' => $request->session()->get('message'),
            'csrf_token' => $request->session()->get('_token')
        ];

        return view('siswa.sekolah.home', $data);
    }

    public function store(Request $request)
    {
        $message = null;

        if (strtolower($request->disable_input_sekolah) != 'on') {

            $validate = Validator::make($request->all(), [
                'jurusan' => 'required',
                'sekolah_asal' => 'required',
                'nisn' => 'required',
                'no_peserta_un' => 'required',
                'nomor_ijazah' => 'required',
                'tanggal_ijazah' => 'required',
                'nomor_skhun' => 'required',
                'tanggal_skhun' => 'required',
                'nilai_mtk' => 'required|numeric|between:0,100.00',
                'nilai_bindo' => 'required|numeric|between:0,100.00',
                'nilai_binggris' => 'required|numeric|between:0,100.00',
                'nilai_ipa' => 'required|numeric|between:0,100.00',
                'nilai_total' => 'required|numeric|between:0,400.00',
                'nilai_ratarata' => 'required|numeric|between:0,100.00',
            ], ["required" => "Kolom :attribute masih kosong!"]);


            if($request->file('file_skhun')) {
                 if($request->file('file_skhun')->isValid()) {

                    $filename_skhun = "SK". $request->session()->get('registration_id') . "_" . time() . "." . $request->file('file_skhun')->getClientOriginalExtension();

                    $request->file('file_skhun')->move(base_path(config('custom.upload_path') . 'skhun/'), $filename_skhun);

                 } else {
                    $message = "File skhun tidak valid";
                 }
             } else {
                $message = "File skhun tidak ditemukan";
             }

            if($request->file('file_ijazah')){
                if($request->file('file_ijazah')->isValid()){

                    $filename_ijazah = "IJ". $request->session()->get('registration_id') . "_" . time() . "." . $request->file('file_ijazah')->getClientOriginalExtension();

                    $request->file('file_ijazah')->move(base_path(config('custom.upload_path') . 'ijazah/'), $filename_ijazah);

                 } else {
                    $message = "File ijazah tidak valid";
                 }
             } else {
                $message = "File ijazah tidak ditemukan";
             }

        } else {

            $validate = Validator::make($request->all(), [
                'jurusan' => 'required',
                'sekolah_asal' => 'required',
                'nisn' => 'required',
                'no_peserta_un' => 'required',
            ], ["required" => "Kolom :attribute masih kosong!"]);

        }


        if (!$validate->fails() && $message === null) {

            $update = Score::where('registration_id', $request->session()->get('registration_id'))
                ->update([
                    'school_score' => $request->sekolah_asal,
                    'nisn_score' => substr($request->nisn, 0, 10),
                    'mtk_score' => $request->nilai_mtk ?? 0,
                    'indo_score' => $request->nilai_bindo ?? 0,
                    'inggris_score' => $request->nilai_binggris ?? 0,
                    'ipa_score' => $request->nilai_ipa ?? 0,
                    'no_peserta_un' => substr($request->no_peserta_un, 0, 16),
                    'nomor_ijazah' => $request->nomor_ijazah ?? "-",
                    'tanggal_ijazah' => $request->tanggal_ijazah ?? null,
                    'nomor_skhun' => $request->nomor_skhun ?? "-",
                    'tanggal_skhun' => $request->tanggal_skhun ?? null,
                    'rata_rata_score' => $request->nilai_ratarata ?? 0,
                    'total_score' => $request->nilai_total ?? 0

                ]);

            if ($update) {
                Registration::where('id_registration', $request->session()->get('registration_id'))
                ->update(['current_registration' => 'orangtua']);


                Student::where('registration_id', $request->session()->get('registration_id'))
                ->update(['majoring_student' => $request->jurusan]);

                File::Create([
                    'name_file' => $filename_ijazah ?? NULL,
                    'type_file' => 'ijazah',
                    'registration_id' => $request->session()->get('registration_id'),
                    'code_user' => $request->session()->get('code_user')
                ]);

                File::Create([
                    'name_file' => $filename_skhun ?? NULL,
                    'type_file' => 'skhun',
                    'registration_id' => $request->session()->get('registration_id'),
                    'code_user' => $request->session()->get('code_user')
                ]);

            }

            // Score::where
            return redirect('/siswa/pembayaran');
        }

        $message = $validate->errors()->first() ?? $message;
        $request->session()->flash('message', $message);
        return redirect('/siswa/sekolah');

    }

    //
}
