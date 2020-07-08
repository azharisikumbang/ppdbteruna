<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\ParentStudent;

class OrangtuaController extends Controller
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
                $data['redirector'] = ParentStudent::where('registration_id', $request->session()->get('registration_id'))
                    ->first();
            }
        }

        $data = [
            'username' => $request->session()->get('username'),
            'registration_id' => $request->session()->get('registration_id'),
            'agama_form' => config('custom.agama_pendaftar'),
            'pekerjaan_orangtua' => config('custom.pekerjaan_orangtua'),
            'pendidikan_orangtua' => config('custom.pendidikan_orangtua'),
            'message' => $request->session()->get('message'),
            'old' => $data['redirector'] ?? $request->session()->get('old'),
            'csrf_token' => $request->session()->get('_token'),
            'back_url' => url('/siswa/redirector?current=orangtua&to=sekolah')
        ];

        return view('siswa.orangtua.home', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_ayah' => 'required',
            'tempat_lahir_ayah' => 'required',
            'tanggal_lahir_ayah' => 'required',
            'alamat_ayah' => 'required',
            'penghasilan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'agama_ayah' => 'required',
            'nama_ibu' => 'required',
            'tempat_lahir_ibu' => 'required',
            'tanggal_lahir_ibu' => 'required',
            'alamat_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'penghasilan_ibu' => 'required',
            'agama_ibu' => 'required',
            'pendidikan_ayah' => 'required',
            'pendidikan_ibu' => 'required',
        ], ["required" => "Kolom :attribute masih kosong!"]);

        $requestData = [
            'nama_ayah' => $request->nama_ayah,
            'tempat_lahir_ayah' => $request->tempat_lahir_ayah,
            'tanggal_lahir_ayah' => $request->tanggal_lahir_ayah,
            'alamat_ayah' => $request->alamat_ayah,
            'penghasilan_ayah' => $request->penghasilan_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'agama_ayah' => $request->agama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'tempat_lahir_ibu' => $request->tempat_lahir_ibu,
            'tanggal_lahir_ibu' => $request->tanggal_lahir_ibu,
            'alamat_ibu' => $request->alamat_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu' => $request->penghasilan_ibu,
            'agama_ibu' => $request->agama_ibu,
            'nama_wali' => $request->nama_wali,
            'tempat_lahir_wali' => $request->tempat_lahir_wali,
            'tanggal_lahir_wali' => ($request->tanggal_lahir_wali === '') ? NULL : $request->tanggal_lahir_wali,
            'pekerjaan_wali' => $request->pekerjaan_wali,
            'penghasilan_wali' => $request->penghasilan_wali,
            'alamat_wali' => $request->alamat_wali,
            'agama_wali' => $request->agama_wali,
            'phone_ayah' => $request->phone_ayah,
            'phone_ibu' => $request->phone_ibu,
            'phone_wali' => $request->phone_wali,
            'pendidikan_ayah' => $request->pendidikan_ayah,
            'pendidikan_ibu' => $request->pendidikan_ibu,
            'pendidikan_wali' => $request->pendidikan_wali,
        ];

        if (!$validate->fails()) {
            $update = ParentStudent::where('registration_id', $request->session()->get('registration_id'))
                ->update($requestData);

                if ($update) {
                    Registration::where('id_registration', $request->session()->get('registration_id'))
                        ->update(['current_registration' => 'pembayaran']);
                }

            return redirect('/siswa/pembayaran');
        }

        $message = $validate->errors()->first();
        $request->session()->flash('message', $message);
        $request->session()->flash('old', $requestData);
        return redirect('/siswa/orangtua');

    }

    //
}
