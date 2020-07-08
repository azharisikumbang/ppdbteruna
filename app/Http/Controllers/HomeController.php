<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        return view('home');
    }

    public function word()
    {
        // if (isset($_GET['app'])) {
            $pdf = PDF::loadView('templates.bukuinduk');
            return $pdf->setPaper('a3')->download('test.pdf');
        // }

        // return view('templates.bukuinduk');
    }

    //
}
