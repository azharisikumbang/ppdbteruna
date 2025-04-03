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
        $validate = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ], [
            'required' => 'Kolom :attribute masih kosong!',
            'unique' => 'Maaf, email telah digunakan!',
        ]);

        if (!$validate->fails())
        {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student'
            ]);

            if (Registration::orderBy('created_at', 'desc')->first())
            {
                $registration_code = Registration::orderBy('created_at', 'desc')->first()->registration_code;
                if (strpos($registration_code, date("Y")))
                {
                    $registration_code = (int) str_replace("T", "", $registration_code);
                    $registration_code = $registration_code + 1;
                } else
                {
                    $registration_code = date("Y") . '0001';
                }
            } else
            {
                $registration_code = date("Y") . '0001';
            }

            Registration::Create([
                'registration_code' => "T" . $registration_code,
                'registration_status' => 'pending',
                'registration_current_step' => 'awal',
                'current_user_id' => $user->id
            ]);

            // Set session
            $request->session()->put('username', $request->username);
            $request->session()->put('registration_code', "T" . $registration_code);
            $request->session()->put('current_user_id', $user->id);
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
        $validate = Validator::make($request->all(), [
            'username' => 'required|unique:users,username_user',
            'password' => 'required'
        ], [
            'required' => 'Kolom :attribute masih kosong!',
            'unique' => 'Maaf, username telah digunakan!',
        ]);

        if (!$validate->fails())
        {
            $current_user_id = Str::lower(Str::random(32));
            User::create([
                'email' => $request->email,
                'username_user' => $request->username,
                'password_user' => Hash::make($request->password),
                'current_user_id' => $current_user_id,
                'role_user' => 'admin'
            ])->save();

            return redirect('/admin');
        }

        $message = $validate->errors()->first();
        $request->session()->flash('message', $message);
        return redirect('/admin/add');
    }

}
