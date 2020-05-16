<?php

namespace App\Http\Middleware;

use Closure;

class LoginRedirector
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
        if ($request->session()->has('username') || $request->session()->has('registration_id')) {
            if ($request->session()->get('role') === 'admin') {
                return redirect('/admin');
            }

            return redirect('/siswa');
        }

        return $next($request);
    }
}
