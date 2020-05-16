<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Registration;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $registrasi = Registration::with([
                'user' => function($query) {
                    $query->select('code_user', 'username_user');
                }
            ])
            ->orderBy('updated_at', 'desc')
            ->whereDate('updated_at', '=', date("Y-m-d"))
            ->get(['id_registration', 'status_registration', 'validate_by', 'updated_at']);

        $jurusan = [];
        foreach (config('custom.data.jurusan') as $key => $value) {
            $jurusan[$key] = $this->counter('students', ['majoring_student' => $key]);
        }

        $data = [
            'username' => $request->session()->get('username'),
            'role' => $request->session()->get('role'),
            'csrf_token' => $request->session()->get('_token'),
            'html' => [
                'sidebar' => true,
                ['title' => 'Dashboard']
            ],
            'registrasi' => [
                'data' => $registrasi,
                'jurusan' => $jurusan,
                'semua' => $this->counter('registrations'),
                'tervalidasi' => $this->counter('registrations', ['status_registration' => 'tervalidasi']),
                'menunggu' => $this->counter('registrations', ['status_registration' => 'menunggu']),
                'pending' => $this->counter('registrations', ['status_registration' => 'pending']),
                'gagal' => $this->counter('registrations', ['status_registration' => 'gagal'])
            ],
            'logger' => [
                'tervalidasi' => ['berhasil divalidasi oleh', 'green'],
                'menunggu' => ['telah melampirkan bukti pembayaran mohon untuk divalidasi segera', 'orange'],
                'pending' => ['mendaftar sebagai calon peserta didik baru', 'gray'],
                'gagal' => ['bermasalah untuk saat melakukan pendaftaran, mohon ditinjau', 'red']
            ]
        ];

        return view('admin.home', $data);
    }

    public function search(Request $request, Response $response)
    {
        $data = ['message' => 'not found'];

        if ($request->q) {
            $searchTerm = $request->q;
            $registrasi = Registration::query()->with(['file', 'payment'])
                    ->select(
                        'registrations.id_registration',
                        'registrations.status_registration',
                        'students.name_student'
                    )
                    ->join('students', 'students.registration_id', 'registrations.id_registration')
                    ->where('id_registration','LIKE','%'.$searchTerm.'%')
                    ->orWhere('name_student', 'LIKE','%'.$searchTerm.'%')
                    ->orWhere('status_registration', 'LIKE','%'.$searchTerm.'%')
                    ->paginate(10);

            $data = [
                'username' => $request->session()->get('username'),
                'role' => $request->session()->get('role'),
                'csrf_token' => $request->session()->get('_token'),
                'code_user' => $request->session()->get('code_user'),
                'registrasi' => $registrasi,
                'validasi' => false,
                'html' => [
                    'color' => config('custom.html.color')
                ]
            ];

            return view('admin.validasi', $data);
        }

        abort(404);

    }

    private function counter($table, $where = null)
    {
        if ($where) {
            return DB::table($table)
                ->selectRaw('count(*) as counter')
                ->where($where)
                ->first();
        }

        return DB::table($table)
            ->selectRaw('count(*) as counter')
            ->first();
    }
    //
}
