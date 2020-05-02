<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Student;
use App\Models\File;

class DataController extends Controller
{

     public function index(Request $request, Response $response)
    {
        $data = Registration::with('student')->paginate();
        return response()->json($data);
    }

    public function validasi(Request $request)
    {

        $registrasi = $this->getData($request, ['status_registration' => 'menunggu']);

        $data = $this->setRenderData($request, $registrasi, ['title' => 'Form Validasi']);

        return view('admin.validasi', $data);
    }

    public function all(Request $request)
    {
        $registrasi = $this->getAll($request);

        $data = $this->setRenderData($request, $registrasi, ['title' => 'Semua Data'], false);

        return view('admin.validasi', $data);
    }

    public function status(Request $request)
    {
        $registrasi = $this->getData($request, ['status_registration' => $request->status]);

        $data = $this->setRenderData($request, $registrasi, ['title' => $request->status], false);

        return view('admin.validasi', $data);
    }



    public function validator(Request $request, Response $response)
    {
        $validate = Validator::make($request->all(), [
            'regid' => 'required',
            'validator' => 'required',
            'status' => 'required'
        ]);


        if (!$validate->fails()) {
            Registration::where('id_registration', $request->regid)
                ->update([
                    'status_registration' => $request->status,
                    'validate_by' => $request->validator
                ]);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil!'
            ]);
        }


        abort(404);

    }

    public function detail(Request $request)
    {
        $registrasi = Registration::with(['student', 'file', 'payment'])
        ->where('id_registration', $request->regid)
        ->first();

        $data = [
            'username' => $request->session()->get('username'),
            'role' => $request->session()->get('role'),
            'registrasi' => $registrasi,
            'code_user' => $request->session()->get('code_user')
        ];

        return view('admin.detail', $data);

    }

    private function getData($request, $where)
    {
        return Registration::with([
            'student' => function($query) {
                $query->select('registration_id', 'name_student');
            },
            'file' => function($query) {
                $query->select('registration_id', 'name_file')->where('type_file', 'pembayaran');
            },
            'payment' => function($query) {
                $query->select('registration_id', 'number_payment');
            }
        ])
        ->where($where)
        ->paginate(10, ['id_registration', 'status_registration']);
    }

    private function getAll($request)
    {
        return Registration::with([
            'student' => function($query) {
                $query->select('registration_id', 'name_student');
            },
            'file' => function($query) {
                $query->select('registration_id', 'name_file')->where('type_file', 'pembayaran');
            },
            'payment' => function($query) {
                $query->select('registration_id', 'number_payment');
            }
        ])
        ->paginate(10, ['id_registration', 'status_registration']);
    }

    private function setRenderData($request, $data, $html, $validasi = true)
    {
        return [
            'username' => $request->session()->get('username'),
            'role' => $request->session()->get('role'),
            'registrasi' => $data,
            'code_user' => $request->session()->get('code_user'),
            'validasi' => $validasi,
            'html' => [
                'color' => [
                    'tervalidasi' => 'green',
                    'pending' => 'gray',
                    'menunggu' => 'yellow',
                    'gagal' => 'red',
                ], $html
            ]
        ];
    }

}
