<?php

namespace App\Exceptions;

use App\LaravelLog;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        $log = [
            'message' => json_encode($exception->getMessage()),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'detail' => json_encode($exception->getTrace())
        ];

        dd(Request::input('googleID')); die();

//        $log = [
//            'message' => 'test',
//            'file' => 'test',
//            'line' => 'test',
//            'detail' => 'test',
//        ];

        LaravelLog::create($log);

//        return parent::report($exception);
        return $log;
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}
