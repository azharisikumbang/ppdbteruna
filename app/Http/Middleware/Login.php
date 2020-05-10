<?php

namespace App\Http\Middleware;

use Closure;

class Login
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
        if (!$request->session()->has('username') || (!$request->session()->has('registration_id') && $request->session()->get('role') !== 'admin')) {
            return redirect('/masuk');
        }

        return $next($request);
    }
}
