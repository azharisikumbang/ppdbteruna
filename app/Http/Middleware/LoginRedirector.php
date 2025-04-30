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
        if ($user = auth()->user())
            return redirect()->to($user->getAuthHome());

        return $next($request);
    }
}
