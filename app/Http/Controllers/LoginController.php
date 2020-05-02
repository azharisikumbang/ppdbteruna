<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class loginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $data['message'] = $request->session()->get('message');
        $data['username'] = $request->session()->get('username');
        return view('login.home', $data);
    }

    public function verify(Request $request)
    {
        $message = 'Username atau password salah, silahkan coba lagi!';

        $validate = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            $message = "Form isian masih kosong";
        }

        $user = User::where('username_user', $request->username)
            ->first();

        if ($user) {
            if (Hash::check($request->password, $user->password_user)) {
                // set session
                $request->session()->put('registration_id', $request->registration_id);
                $request->session()->put('username', $request->username);
                $request->session()->put('code_user', $user->code_user);
                $request->session()->put('role', $user->role_user);
                if ($user->role_user == 'admin') {
                    return redirect('/admin');
                }
                return redirect('/siswa');
            }
        }

        $request->session()->flash('message', $message);
        $request->session()->flash('username', $request->username);

        return redirect('/masuk');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

    public function change(Request $request)
    {
        $data['message'] = $request->session()->get('message');
        return view('login.change', $data);
    }

    public function updatePassword(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'password' => 'required|confirmed'
        ], ['required' => 'Kolom :attribute masih kosong!', 'confirmed' => 'Password dan password konfirmasi tidak cocok, coba lagi!']);

        if (!$validate->fails()) {
            $user = User::where('username_user', $request->session()->get('username'))
                ->update(['password_user' => Hash::make($request->password)]);

            return redirect('/keluar');
        }

        $request->session()->flash('message', $validate->errors()->first());
        return redirect('/change');
    }

    //
}
