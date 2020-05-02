<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Student;

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
            'sekolah_asal' => 'required',
        ], ["required" => "Kolom :attribute masih kosong!"]);

        if (!$validate->fails()) {
            Registration::where('id_registration', $request->session()->get('registration_id'))
                ->update(['current_registration' => 'pembayaran ']);

            Student::where('registration_id', $request->session()->get('registration_id'))
                ->update(['majoring_student' => $request->jurusan]);
            return redirect('/siswa/pembayaran');
        }

        $message = $validate->errors()->first();
        $request->session()->flash('message', $message);
        return redirect('/siswa/sekolah');

    }

    //
}
