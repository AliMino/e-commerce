<?php

namespace App\Exceptions;

use Throwable;
use App\Exceptions\Api\ApiException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Exceptions\Api\{ UnknownSubdomainException, NoSubdomainProvidedException };

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ApiException) {
            return response()->json([ 'status' => false, 'data' => null, 'error' => $e->toArray() ], $e->getHttpStatusCode());
        }

        if ($e instanceof \Stancl\Tenancy\Exceptions\TenantCouldNotBeIdentifiedOnDomainException) {
            throw new UnknownSubdomainException(explode('.', $request->getHost())[0]);
        }

        if ($e instanceof \Stancl\Tenancy\Exceptions\NotASubdomainException) {
            throw new NoSubdomainProvidedException();
        }
     
        throw new ApiException($e->getMessage(), 0, Response::HTTP_INTERNAL_SERVER_ERROR, [], $e);
    }
}
