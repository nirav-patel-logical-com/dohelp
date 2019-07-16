<?php

namespace App\Exceptions;

use App\Http\Controllers\BSPController;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {$BSPController = new BSPController();
        if ($exception instanceof UnauthorizedHttpException) {
            $preException = $exception->getPrevious();
            if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
            {
                $BSPController->send_response_api(404,'TOKEN EXPIRED','');
                exit;
            }
            else if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
            {
                $BSPController->send_response_api(404,'TOKEN INVALID','');
                exit;
            }
            else if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {

                $BSPController->send_response_api(404,'TOKEN BLACKLISTED','');
                exit;
            }
        }
        if ($exception->getMessage() === 'Token not provided')
        {
            $BSPController->send_response_api(404,'Token not provided','');
            exit;
           // return response()->json(['error' => 'Token not provided']);
        }
        return parent::render($request, $exception);
    }
}
