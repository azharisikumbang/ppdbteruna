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
use Barryvdh\DomPDF\Facade as PDF;

class DataController extends Controller
{

    public function validasi(Request $request)
    {

        $registrasi = $this->getData($request, ['status_registration' => 'menunggu']);

        $data = $this->setRenderData($request, $registrasi, ['title' => 'Form Validasi']);
        $data['csrf_token'] = $request->session()->get('_token');

        return view('admin.validasi', $data);
    }

    public function all(Request $request)
    {
        $registrasi = $this->getAll($request);

        $data = $this->setRenderData($request, $registrasi, ['title' => 'Semua Data'], false);
        $data['csrf_token'] = $request->session()->get('_token');

        return view('admin.validasi', $data);
    }

    public function status(Request $request)
    {
        $registrasi = $this->getData($request, ['status_registration' => $request->status]);

        $data = $this->setRenderData($request, $registrasi, ['title' => $request->status], false);
        $data['csrf_token'] = $request->session()->get('_token');

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
        $registrasi = Registration::with([
                'student',
                'file' => function($query) {
                    $query->orderBy('created_at', 'asc');
                },
                'payment',
                'parent',
                'score'
            ])
            ->where('id_registration', $request->regid)
            ->first();

        $data = [
            'username' => $request->session()->get('username'),
            'role' => $request->session()->get('role'),
            'registrasi' => $registrasi,
            'code_user' => $request->session()->get('code_user'),
            'csrf_token' => $request->session()->get('_token')
        ];

        return view('admin.detail', $data);

    }

    public function regenerate(Request $request)
    {
        $filename = "B" . $request->regid . '_' . time() . '.pdf';

        File::where([
            'registration_id' => $request->regid,
            'type_file' => 'biodata'
        ])
        ->update([
            'name_file' => $filename,
        ]);

        $biodata = Registration::with([
                'student',
                'file' => function($query) {
                    $query->orderBy('created_at', 'asc');
                },
                'payment',
                'parent',
                'score'
            ])
            ->where('id_registration', $request->regid)
            ->first();

        $pdf = PDF::loadView('templates.biodata', ['data' => $biodata]);
        $pdf->setPaper('a4')->save(base_path(config('custom.upload_path') . 'biodata/' . $filename));

        return redirect('/admin/detail/' . $request->regid);

    }

    private function getData($request, $where)
    {
        return Registration::with([
            'student' => function($query) {
                $query->select('registration_id', 'name_student');
            },
            'file' => function($query) {
                $query->select('registration_id', 'name_file')->where('type_file', 'pembayaran');
                $query->orderBy('created_at', 'asc');
            },
            'payment' => function($query) {
                $query->select('registration_id', 'number_payment', 'bank_payment');
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
                $query->orderby('name_file');
            },
            'payment' => function($query) {
                $query->select('registration_id', 'number_payment', 'bank_payment');
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
                'color' => config('custom.html.color'),
                $html
            ]
        ];
    }

}
