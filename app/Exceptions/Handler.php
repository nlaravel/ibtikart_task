<?php

namespace App\Exceptions;
use App\Mail\ExceptionMail;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Log;
use Throwable;
use Symfony\Component\ErrorHandler\ErrorRenderer\HtmlErrorRenderer;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */

    public function report(Throwable $exception)
    {
        // emails.exception is the template of your email
        // it will have access to the $error that we are passing below

        if ($this->shouldReport($exception)) {
            $this->sendEmail($exception); // sends an email
        }

        return parent::report($exception);

    }

    public function render($request, Throwable $exception)
    {
        // dd($exception->message());
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            return response()->json(['User have not permission for this page access.']);
        }
        return parent::render($request, $exception);

    }

    public function sendEmail(Throwable $exception)
    {

        // dd( $exception );
        try {
            $e = FlattenException::create($exception);
            $handler = new HtmlErrorRenderer(true); // boolean, true raises debug flag...
            $css = $handler->getStylesheet();
            $content = $exception;
//            $content=  \Illuminate\Support\Str::limit($exception,300);
//
            \Mail::send('emails.exception_email', compact('css','content'), function ($message) {
                $message->to('admin@gmail.com')
                    ->subject('Exception: ' . \Request::fullUrl());
            });
        } catch (Throwable $exception) {
            Log::error($exception);

        }

    }

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
