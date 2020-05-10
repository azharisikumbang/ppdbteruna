<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Registration as Regis;

class Registration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $current = Regis::where('code_user', $request->session()->get('code_user'))
            ->first('current_registration');

        $url = explode("/", rtrim($request->url(), "/"));

        if ((end($url) != 'siswa') && (end($url) !== $current->current_registration)) {
            switch ($current->current_registration) {
                case 'pemberkasan':
                    $redirect = '/siswa/pemberkasan';
                    break;
                case 'sekolah':
                    $redirect = '/siswa/sekolah';
                    break;
                case 'orangtua':
                    $redirect = '/siswa/orangtua';
                    break;
                case 'pembayaran':
                    $redirect = '/siswa/pembayaran';
                    break;
                case 'selesai':
                    $redirect = '/siswa/selesai';
                    break;

                default:
                    Regis::where('id_registration', $request->session()->get('registration_id'))
                        ->update(['current_registration' => 'pemberkasan']);
                    $redirect = '/siswa/pemberkasan';
                    break;
            }

            return redirect($redirect);
        }

        return $next($request);
    }
}
