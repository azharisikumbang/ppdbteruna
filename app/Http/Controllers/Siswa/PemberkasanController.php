<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Registration;

class PembekasanController extends Controller
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
            'provinsi' => config('custom.provinsi'),
            'status_pendaftar' => config('custom.status_pendaftar'),
            'orangtua_pendaftar' => config('custom.orangtua_pendaftar'),
            'agama_pendaftar' => config('custom.agama_pendaftar'),
            'message' => $request->session()->get('message')
        ];
        return view('siswa.pemberkasan.home', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_depan' => 'required',
            'nik_siswa' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'status' => 'required',
            'orangtua' => 'required',
            'alamat' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'pos' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'handphone' => 'required'
        ], [
            'required' => 'Kolom :attribute masih kosong!',
        ]);

        if (!$validate->fails()) {
            if (Registration::orderBy('created_at', 'desc')->first()) {
                $id_registration = Registration::orderBy('created_at', 'desc')->first()->id_registration;
                if (strpos($id_registration, date("Y"))) {
                    $id_registration = (int) str_replace("T", "", $id_registration);
                    $registration_id = $id_registration + 1;
                } else {
                    $registration_id = date("Y") . '0001';
                }
            } else {
                $registration_id = date("Y") . '0001';
            }

            Registration::where('id_registration', $request->session()->get('registration_id'))
                ->update(['current_registration' => 'sekolah']);

            Student::where('registration_id', $request->session()->get('registration_id'))->update([
                'name_student' => $request->nama_depan,
                'birthplace_student' => $request->tempat_lahir,
                'birthdate_student' => $request->tanggal_lahir,
                'address_student' => $request->alamat,
                'phone_student' => $request->handphone,
                'status_student' => $request->status,
                'parent_student' => $request->orangtua,
                'agama_student' => $request->agama,
                'gender_student' => $request->jenis_kelamin,
                'nik_student' => substr($request->nik_siswa, 0, 16),
                'desa_student' => $request->desa,
                'kecamatan_student' => $request->kecamatan,
                'kota_student' => $request->kota,
                'provinsi_student' => $request->provinsi,
                'pos_student' => $request->pos,
                'rt_rw_student' => $request->rt . "/" . $request->rw,
                'code_user' => $request->session()->get('code_user'),
            ]);

            return redirect('/siswa/sekolah');
        }

        $message = $validate->errors()->first();
        $request->session()->flash('message', $message);
        return redirect('/siswa/pemberkasan');

    }

    //
}
