<?php

namespace App\Exceptions;

use Throwable;
use App\Services\GeneralService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Exceptions\Api\{ ApiException, UnknownSubdomainException, NoSubdomainProvidedException, RouteNotFoundException };

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
            return $this->container->make(GeneralService::class)->getErrorResponse(
                $e->toArray(config('app.debug')), $e->getHttpStatusCode()
            );
        }

        if ($e instanceof \Stancl\Tenancy\Exceptions\TenantCouldNotBeIdentifiedOnDomainException) {
            throw new UnknownSubdomainException(explode('.', $request->getHost())[0]);
        }

        if ($e instanceof \Stancl\Tenancy\Exceptions\NotASubdomainException) {
            throw new NoSubdomainProvidedException();
        }

        if ($e instanceof \Symfony\Component\Routing\Exception\RouteNotFoundException) {
            throw new RouteNotFoundException(preg_replace([ '/^\w+ \[/', '/\].*$/' ], '', $e->getMessage()));
        }

        throw new ApiException($e->getMessage(), 0, Response::HTTP_INTERNAL_SERVER_ERROR, [], $e);
    }
}
