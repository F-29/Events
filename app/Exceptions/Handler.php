<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

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
     * @param \Exception $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if ($request->wantsJson()) {
            $exception = $this->prepareException($exception);
            $code = method_exists($exception, 'getStatusCode')
                ? $exception->getStatusCode()
                : $exception->getCode();
            $code = empty($code) ? 500 : $code;
            return $this->requestErrorHandler($exception, $code);
        }
        return parent::render($request, $exception);
    }


    /**
     * @param Exception $exception
     * @param int $code
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    private function requestErrorHandler(Exception $exception, int $code)
    {
        if ($code == 23000) {
            return $this->_userAlreadyExistsError();
        }

        if ($exception instanceof ValidationException) {
            return $this->_validationError($exception);
        }

        if ($exception instanceof AuthenticationException) {
            return $this->_authenticationError($exception);
        }

        return $this->_internalServerError($exception, $code);
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    private function _userAlreadyExistsError()
    {
        return response([
            'message' => 'user already exists',
        ], 409);
    }

    /**
     * @param Exception $exception
     * @param int $code
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    private function _internalServerError(Exception $exception, int $code)
    {
        return response([
            'message' => $code == 500 ? 'there has been an error in the server side' . " : " . (string)$exception : $exception->getMessage(),
        ], $code);
    }

    private function _validationError(Exception $exception)
    {
        return response(['errors' => $exception->errors()], 422);
    }

    private function _authenticationError(Exception $exception)
    {
        return response(['errors' => "unfortunately you are currently Unauthorized."], 401);
    }
}
