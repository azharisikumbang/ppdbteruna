<?php

namespace App\Http\Controllers\Siswa;

use App\Actions\SimpanFormDataSekolah;
use App\Http\Requests\StoreDataSekolahRequest;
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

        if (isset($request->from)) {
            if (in_array(strtolower($request->from), config('custom.status'))) {
                $data['redirector'] = Score::where('registration_id', $request->session()->get('registration_id'))
                    ->first();

                $jurusan = Student::where('registration_id', $request->session()->get('registration_id'))
                    ->first(['registration_id', 'majoring_student']);
                $data['redirector']['majoring_student'] = $jurusan->majoring_student;
            }
        }

        $data = [
            'username' => $request->session()->get('username'),
            'registration_id' => $request->session()->get('registration_id'),
            'jurusan' => config('custom.data.jurusan'),
            'message' => $request->session()->get('message'),
            'csrf_token' => $request->session()->get('_token'),
            'old' => $data['redirector'] ?? $request->session()->get('old'),
            'back_url' => url('/siswa/redirector?current=sekolah&to=pemberkasan')
        ];

        return view('siswa.sekolah.home', $data);
    }

    public function store(StoreDataSekolahRequest $request, SimpanFormDataSekolah $action)
    {
        $registration = auth()->user()->registration;
        $action->handle($registration, $request);

        return redirect()->to('siswa/orangtua');
    }

    //
}
