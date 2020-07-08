<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Registration;
use App\Models\File;

class PembekasanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {

        if (isset($request->from)) {
            if (in_array(strtolower($request->from), config('custom.status'))) {
                $data['redirector'] = Student::where('registration_id', $request->session()->get('registration_id'))
                    ->first();
            }
        }

        $data = [
            'username' => $request->session()->get('username'),
            'provinsi' => config('custom.provinsi'),
            'status_pendaftar' => config('custom.status_pendaftar'),
            'orangtua_pendaftar' => config('custom.orangtua_pendaftar'),
            'agama_pendaftar' => config('custom.agama_pendaftar'),
            'bantuan_pendaftar' => config('custom.bantuan_pendaftar'),
            'home_pendaftar' => config('custom.home_pendaftar'),
            'message' => $request->session()->get('message'),
            'old' => $data['redirector'] ?? $request->session()->get('old'),
            'csrf_token' => $request->session()->get('_token')
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
            'status' => 'required',
            'orangtua' => 'required',
            'alamat' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
        ], [
            'required' => 'Kolom :attribute masih kosong!'
        ]);

        if (!$validate->fails()) {

            $filename = NULL;

            if ($request->file('photo') != null) {
                if ($request->file('photo')->isValid()) {
                    $filename = "F". $request->session()->get('registration_id') . "_" . time() . "." . $request->file('photo')->getClientOriginalExtension();

                    $request->file('photo')->move(base_path(config('custom.upload_path') . 'photo/'), $filename);
                }
            }

            if (
                File::where([
                    'type_file' => 'photo',
                    'registration_id' => $request->session()->get('registration_id')
                ])->exists())
            {

                File::where([
                    'type_file' => 'photo',
                    'registration_id' => $request->session()->get('registration_id')
                ])->update(['name_file' => $filename]);

            } else {
                File::Create([
                    'name_file' => $filename,
                    'type_file' => 'photo',
                    'registration_id' => $request->session()->get('registration_id'),
                    'code_user' => $request->session()->get('code_user')
                ]);
            }

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

            $update = Student::where('registration_id', $request->session()->get('registration_id'))->update([
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
                'child_order_student' => $request->child_order,
                'siblings_student' => $request->siblings,
                'blood_student' => $request->blood,
                'transport_student' => $request->transport,
                'distance_student' => $request->distance,
                'accommodation_student' => $request->accommodation,
                'home_student' => $request->home,
                'rt_rw_student' => $request->rt . "/" . $request->rw,
                'code_user' => $request->session()->get('code_user')
            ]);

            if ($update) {
                Registration::where('id_registration', $request->session()->get('registration_id'))
                ->update(['current_registration' => 'sekolah']);
            }

            return redirect('/siswa/sekolah');
        }

        $old = [
            'nama_depan' => $request->nama_depan,
            'nik_siswa' => $request->nik_siswa,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'status' => $request->status,
            'orangtua' => $request->orangtua,
            'alamat' => $request->alamat,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'pos' => $request->pos,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'handphone' => $request->handphone,
            'transport' => $request->transport,
            'distance' => $request->distance,
            'accommodation' => $request->accommodation,
            'home' => $request->home,
            'siblings' => $request->siblings,
            'child_order' => $request->child_order,
        ];

        $message = $validate->errors()->first();
        $request->session()->flash('message', $message);
        $request->session()->flash('old', $old);
        return redirect('/siswa/pemberkasan');

    }

    //
}
