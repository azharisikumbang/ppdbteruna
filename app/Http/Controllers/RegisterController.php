<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
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
        return view('register.home');
    }

    public function store(UserRegistrationRequest $request)
    {
        $validated = $request->validated();

        User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => User::ROLE_SISWA
        ]);

        return redirect()->to('/masuk');
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
