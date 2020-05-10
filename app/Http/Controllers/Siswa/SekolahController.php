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
            'message' => $request->session()->get('message')
        ];

        return view('siswa.sekolah.home', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'jurusan' => 'required',
            'nisn' => 'required',
            'sekolah_asal' => 'required',
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
            'file_ijazah' => 'required',
            'file_skhun' => 'required'
        ], ["required" => "Kolom :attribute masih kosong!"]);

        if (!$validate->fails()) {

            if($request->file('file_ijazah')->isValid()){

                $filename = "IJ". $request->session()->get('registration_id') . "_" . time() . "." . $request->file('file_ijazah')->getClientOriginalExtension();

                $request->file('file_ijazah')->move(base_path('public/files/ijazah/'), $filename);

                File::Create([
                    'name_file' => $filename,
                    'type_file' => 'ijazah',
                    'registration_id' => $request->session()->get('registration_id'),
                    'code_user' => $request->session()->get('code_user')
                ]);

             }

            if($request->file('file_skhun')->isValid()){

                $filename = "SK". $request->session()->get('registration_id') . "_" . time() . "." . $request->file('file_skhun')->getClientOriginalExtension();

                $request->file('file_skhun')->move(base_path('public/files/skhun/'), $filename);

                File::Create([
                    'name_file' => $filename,
                    'type_file' => 'skhun',
                    'registration_id' => $request->session()->get('registration_id'),
                    'code_user' => $request->session()->get('code_user')
                ]);

             }

            Registration::where('id_registration', $request->session()->get('registration_id'))
                ->update(['current_registration' => 'orangtua']);

            Student::where('registration_id', $request->session()->get('registration_id'))
                ->update(['majoring_student' => $request->jurusan]);

            Score::where('registration_id', $request->session()->get('registration_id'))
                ->update([
                    'school_score' => $request->sekolah_asal,
                    'nisn_score' => substr($request->nisn, 0, 10),
                    'mtk_score' => $request->nilai_mtk,
                    'indo_score' => $request->nilai_bindo,
                    'inggris_score' => $request->nilai_binggris,
                    'ipa_score' => $request->nilai_ipa,
                    'no_peserta_un' => substr($request->no_peserta_un, 0, 16),
                    'nomor_ijazah' => $request->nomor_ijazah,
                    'tanggal_ijazah' => $request->tanggal_ijazah,
                    'nomor_skhun' => $request->nomor_skhun,
                    'tanggal_skhun' => $request->tanggal_skhun,
                    'rata_rata_score' => $request->nilai_ratarata,
                    'total_score' => $request->nilai_total

                ]);

            // Score::where
            return redirect('/siswa/pembayaran');
        }

        $message = $validate->errors()->first();
        $request->session()->flash('message', $message);
        return redirect('/siswa/sekolah');

    }

    //
}
