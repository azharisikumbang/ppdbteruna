<?php

namespace App\Http\Controllers\Siswa;

use App\Actions\SimpanFormPemberkasan;
use App\Http\Requests\StorePemberkasanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Registration;
use App\Models\File;

class PemberkasanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        if (isset($request->from))
        {
            if (in_array(strtolower($request->from), config('custom.status')))
            {
                $data['redirector'] = Student::where('registration_id', $request->session()->get('registration_code'))
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

    public function store(StorePemberkasanRequest $request, SimpanFormPemberkasan $action)
    {
        $registration = auth()->user()->registration()->first();
        $result = $action->handle($registration, $request);

        // handle success
        if ($result instanceof Registration)
        {
            /** @var Registration $result  */
            $result->update(['registration_current_step' => Registration::STEP_DATA_SEKOLAH]);

            return redirect()->route('sekolah.create');
        }


        return redirect('/siswa/sekolah');
    }

    //
}
