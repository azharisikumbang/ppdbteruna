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

        if (isset($request->from)) {
            if (in_array(strtolower($request->from), config('custom.status'))) {
                $data['redirector'] = Payment::where('registration_id', $request->session()->get('registration_id'))
                    ->first();
            }
        }

        $data = [
            'username' => $request->session()->get('username'),
            'registration_id' => $request->session()->get('registration_id'),
            'bank_payment' => config('custom.bank_payment'),
            'message' => $request->session()->get('message'),
            'csrf_token' => $request->session()->get('_token'),
            'old' => $data['redirector'] ?? $request->session()->get('old'),
            'back_url' => url('/siswa/redirector?current=pembayaran&to=orangtua')
        ];

        return view('siswa.pembayaran.home', $data);
    }

    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'nama_rekening' => 'required',
            'bank_rekening' => 'required',
            'nomor_rekening' => 'required',
            'nominal' => 'required',
            'file' => 'required|image|mimes:jpeg,png,gif,webp|max:2048'
        ], ['required' => 'Kolom :attribute masih kosong!']);

        $requestData = [
            'registration_id' => $request->session()->get('registration_id'),
            'name_payment' => $request->nama_rekening,
            'bank_payment' => $request->bank_rekening,
            'number_payment' => $request->nomor_rekening,
            'nominal_payment' => $request->nominal,
            'code_user' => $request->session()->get('code_user')
        ];

        if (!$validate->fails()) {

            if ($request->file('file')->isValid()) {

                $update = Payment::Create($requestData);

                $filename = "P". $request->session()->get('registration_id') . "_" . time() . "." . $request->file('file')->getClientOriginalExtension();

                $request->file('file')->move(base_path(config('custom.upload_path') . 'pembayaran/'), $filename);

                if (File::where([
                        'type_file' => 'pembayaran',
                        'registration_id' => $request->session()->get('registration_id')
                    ])->exists()) {

                    File::where([
                        'type_file' => 'pembayaran',
                        'registration_id' => $request->session()->get('registration_id')
                    ])->update(['name_file' => $filename ?? NULL]);

                } else {
                    File::Create([
                        'name_file' => $filename ?? NULL,
                        'type_file' => 'pembayaran',
                        'registration_id' => $request->session()->get('registration_id'),
                        'code_user' => $request->session()->get('code_user')
                    ]);
                }

                if ($update) {
                    Registration::where('id_registration', $request->session()->get('registration_id'))
                    ->update(['current_registration' => 'selesai', 'status_registration' => 'menunggu']);
                }


                return redirect('/siswa/selesai');
            }

            $message = "Mohon sertakan file bukti pembayaran yang benar!";
        }

        $message = (isset($message)) ? $message : $validate->errors()->first();

        $request->session()->flash('message', $message);
        $request->session()->flash('old', $requestData);
        return redirect('/siswa/pembayaran');
    }

    //
}
