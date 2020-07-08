<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;

class ViewerController extends Controller
{
    public function jurusan(Request $request)
    {

        $jurusan = ($request->jurusan == 'ak') ? ucwords($request->jurusan) : strtoupper($request->jurusan);

        $data = [
            'username' => $request->session()->get('username'),
            'role' => $request->session()->get('role'),
            'csrf_token' => $request->session()->get('_token'),
            'html' => [
                [
                    'title' => 'Jurusan ' . config('custom.data.jurusan.' . $jurusan)
                ]
            ]
        ];

        $data['students'] = Student::where(['majoring_student' => strtoupper($request->jurusan)])
            ->paginate(10, ['id_student', 'name_student', 'gender_student', 'created_at', 'registration_id']);

        return view('admin.viewer.jurusan', $data);
    }

}
