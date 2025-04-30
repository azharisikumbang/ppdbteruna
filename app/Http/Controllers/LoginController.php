<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
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

    public function verify(LoginRequest $request)
    {
        if (Auth::attempt($request->validated()))
            return redirect()->to(auth()->user()->getAuthHome());

        return redirect()
            ->back()
            ->withInput(['email' => $request->get('email')])
            ->withErrors(['invalid_credentials' => 'email atau password salah, silahkan coba lagi!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

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
