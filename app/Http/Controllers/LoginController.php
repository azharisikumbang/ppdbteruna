<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Registration;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $data = [
            'message' => '',
            'email' => '',
            'csrf_token' => $request->session()->get('_token')

        ];
        $session = $request->session()->all();

        if (isset($session['message']))
        {

            $data = [
                'message' => $request->session()->get('message')['message'],
                'email' => $request->session()->get('message')['email']
            ];
        }

        return view('login.home', $data);
    }

    public function verify(Request $request)
    {
        $message = 'email atau password salah, silahkan coba lagi!';

        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validate->fails())
        {
            $message = "Form isian masih kosong";
        } else
        {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            {
                $request->session()->regenerate();

                dd(auth()->user());

                if (Auth::user()->role == 'admin')
                {
                    return redirect('/admin');
                }

                return redirect('/siswa');
            }
        }

        $request->session()->flash('message', ['message' => $message, 'email' => $request->email]);

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

        if (!$validate->fails())
        {
            $user = User::where('email_user', $request->session()->get('email'))
                ->update(['password_user' => Hash::make($request->password)]);

            return redirect('/keluar');
        }

        $request->session()->flash('message', $validate->errors()->first());
        return redirect('/change');
    }

    //
}
