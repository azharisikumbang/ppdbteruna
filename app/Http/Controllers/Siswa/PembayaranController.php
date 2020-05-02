<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\File;
use App\Models\Student;
use App\Models\Registration;


class PembayaranController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $jurusan = Student::where('registration_id', $request->session()->get('registration_id'))
            ->first('majoring_student');

        $nominal = config('custom.data.biaya.' . $jurusan->majoring_student);

        $data = [
            'username' => $request->session()->get('username'),
            'registration_id' => $request->session()->get('registration_id'),
            'nominal' => $nominal,
            'message' => $request->session()->get('message'),
        ];

        return view('siswa.pembayaran.home', $data);
    }

    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'nama_rekening' => 'required',
            'nomor_rekening' => 'required',
            'nominal' => 'required',
            'file' => 'required'
        ], ['required' => 'Kolom :attribute masih kosong!']);

        if (!$validate->fails()) {


            if ($request->file('file')->isValid()) {

                Payment::Create([
                    'registration_id' => $request->session()->get('registration_id'),
                    'name_payment' => $request->nama_rekening,
                    'number_payment' => $request->nomor_rekening,
                    'code_user' => $request->session()->get('code_user')
                ]);

                $filename = "P". $request->session()->get('registration_id') . "_" . time() . "." . $request->file('file')->getClientOriginalExtension();

                $request->file('file')->move(base_path('public/files/pembayaran/'), $filename);

                File::Create([
                    'name_file' => $filename,
                    'type_file' => 'pembayaran',
                    'registration_id' => $request->session()->get('registration_id'),
                    'code_user' => $request->session()->get('code_user')
                ]);

                Registration::where('id_registration', $request->session()->get('registration_id'))
                ->update(['current_registration' => 'selesai', 'status_registration' => 'menunggu']);

                return redirect('/siswa/selesai');
            }

            $message = "Mohon sertakan file bukti pembayaran yang benar!";
        }

        $message = (isset($message)) ? $message : $validate->errors()->first();

        $request->session()->flash('message', $message);
        return redirect('/siswa/pembayaran');
    }

    //
}
