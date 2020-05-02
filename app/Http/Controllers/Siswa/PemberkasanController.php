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
            'message' => $request->session()->get('message')
        ];
        return view('siswa.pemberkasan.home', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
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
                'name_student' => $request->nama_depan . ' ' . $request->nama_belakang,
                'address_student' => $request->alamat . ", " . $request->kota . ", " . $request->provinsi,
                'phone_student' => $request->handphone,
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
