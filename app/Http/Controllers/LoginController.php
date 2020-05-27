<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Registration;

class loginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $data['message'] = $request->session()->get('message')['message'];
        $data['username'] = $request->session()->get('message')['username'];
        $data['csrf_token'] = $request->session()->get('_token');

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
        } else {
            $user = User::where('username_user', $request->username)
            ->first();

            if ($user) {
                if (Hash::check($request->password, $user->password_user)) {

                    $registration = Registration::where('code_user', $user->code_user)
                        ->get(['id_registration']);

                    // set session
                    if (isset($registration[0]['id_registration'])) {
                        $request->session()->put('registration_id', $registration[0]['id_registration']);
                    }

                    $request->session()->put('username', $request->username);
                    $request->session()->put('code_user', $user->code_user);
                    $request->session()->put('role', $user->role_user);
                    if ($user->role_user == 'admin') {
                        return redirect('/admin');
                    }
                    return redirect('/siswa');
                }
            }
        }

        $request->session()->flash('message', ['message' => $message, 'username' => $request->username]);
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
        $data['csrf_token'] = $request->session()->get('_token');
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
