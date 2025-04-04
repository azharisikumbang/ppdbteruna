<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use Illuminate\Support\Facades\App;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if (
            $exception instanceof ValidationException &&
            App::environment(['testing'])
        )
        {
            dd($exception->validator->getMessageBag());
        }

        if (App::environment(['local', 'staging']))
        {
            return parent::render($request, $exception);
        }

        // $status = app('Illuminate\Http\Response')->status();
        // switch ($status) {
        //     case 401:
        //     case 402:
        //     case 403:
        //     case 404:
        //         $responseView = '404';
        //         $data['status'] = $responseView;
        //         $data['title'] = 'Page Not Found';
        //         $data['body'] = 'Halaman yang anda tidak memiliki izin untuk mengakses halaman ini. Mohon periksa kembali tujuan anda.';
        //         break;

        //     default:
        //         $responseView = '500';
        //         $data['status'] = $responseView;
        //         $data['title'] = 'Unexpected Error';
        //         $data['body'] = 'Maaf, halaman yang anda akses mengalami sedikit gangguan. mohon kembali lagi nanti.';
        //         break;
        // }

        $responseView = '404';
        $data['status'] = $responseView;
        $data['title'] = 'Page Not Found';
        $data['body'] = 'Halaman yang anda tidak memiliki izin untuk mengakses halaman ini. Mohon periksa kembali tujuan anda.';

        return response()->make(view('errors.page', $data), 404);
    }
}
