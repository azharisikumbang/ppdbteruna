<?php

namespace App\Http\Middleware;

use App\Models\Registration;
use Closure;
use Symfony\Component\HttpFoundation\Response;

class RegistrationStepMiddleware
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
        abort_if(auth()->user()->role != 'student', Response::HTTP_UNAUTHORIZED);

        /** @var Registration $registration */
        $registration = auth()->user()->registration;
        $path = trim($request->path(), '/');

        if ($path == 'siswa')
            return $next($request);


        switch ($registration->registration_current_step)
        {
            case Registration::STEP_AWAL:
                $redirect = 'siswa/pemberkasan';
                break;
            case Registration::STEP_PEMBERKASAN:
                $redirect = 'siswa/pemberkasan';
                break;
            case Registration::STEP_DATA_SEKOLAH:
                $redirect = 'siswa/sekolah';
                break;
            case 'orangtua':
                $redirect = 'siswa/orangtua';
                break;
            case 'pembayaran':
                $redirect = 'siswa/pembayaran';
                break;
            case 'selesai':
                $redirect = 'siswa/selesai';
                break;

            default:
                $redirect = 'siswa';
                break;
        }

        if ($path != $redirect)
        {
            session()->flash('redirect_message', 'Silahkan lanjutkan pendaftaran dari tahapan ini.');
            return redirect()->to($redirect);
        }



        return $next($request);
    }
}
