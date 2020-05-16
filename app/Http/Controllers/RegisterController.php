<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Registration;
use App\Models\Student;
use App\Models\Score;
use App\Models\ParentStudent;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $data['message'] = $request->session()->get('message');
        $data['csrf_token'] = $request->session()->get('_token');
        return view('register.home', $data);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'email' => 'required|email|unique:users,email_user',
            'username' => 'required|unique:users,username_user',
            'password' => 'required'
        ], [
            'required' => 'Kolom :attribute masih kosong!',
            'unique' => 'Maaf, username telah digunakan!',
        ]);

        if (!$validate->fails()) {
            $code_user = Str::lower(Str::random(32));
            User::create([
                'email_user' => $request->email,
                'username_user' => $request->username,
                'password_user' => Hash::make($request->password),
                'code_user' => $code_user,
                'role_user' => 'student'
            ])->save();

            if (Registration::orderBy('created_at', 'desc')->first()) {
                $id_registration = Registration::orderBy('created_at', 'desc')->first()->id_registration;
                if (strpos($id_registration, date("Y"))) {
                    $id_registration = (int) str_replace("T", "", $id_registration);
                    $registration_id = $id_registration + 1;
                } else {
                    $registration_id = date("Y") . '0001';
                }
            } else {
                $registration_id = date("Y") . '0001';
            }

            Registration::Create([
                'id_registration' => "T" . $registration_id,
                'status_registration' => 'pending',
                'current_registration' => 'awal',
                'code_user' => $code_user
            ]);

            Student::Create([
                'registration_id' => "T" . $registration_id,
                'code_user' => $code_user
            ]);

            Score::Create([
                'registration_id' => "T" . $registration_id
            ]);

            ParentStudent::Create([
                'registration_id' => "T" . $registration_id
            ]);

            // Set session
            $request->session()->put('username', $request->username);
            $request->session()->put('registration_id', "T" . $registration_id);
            $request->session()->put('code_user', $code_user);
            $request->session()->put('role', 'student');
            return redirect('/siswa');
        }

        $message = $validate->errors()->first();
        $request->session()->flash('message', $message);
        return redirect('/daftar');
    }

    public function newAdmin(Request $request)
    {
        $data['message'] = $request->session()->get('message');
        return view('admin.add', $data);
    }

    public function addAdmin(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'username' => 'required|unique:users,username_user',
            'password' => 'required'
        ], [
            'required' => 'Kolom :attribute masih kosong!',
            'unique' => 'Maaf, username telah digunakan!',
        ]);

        if (!$validate->fails()) {
            $code_user = Str::lower(Str::random(32));
            User::create([
                'email_user' => $request->email,
                'username_user' => $request->username,
                'password_user' => Hash::make($request->password),
                'code_user' => $code_user,
                'role_user' => 'admin'
            ])->save();

            return redirect('/admin');
        }

        $message = $validate->errors()->first();
        $request->session()->flash('message', $message);
        return redirect('/admin/add');
    }

}
