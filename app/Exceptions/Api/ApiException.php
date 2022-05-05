<?php

namespace App\Exceptions\Api;

use Exception, Throwable;
use Symfony\Component\HttpFoundation\Response;

/**
 * Api Exception.
 * 
 * @api
 * @version 1.1.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
class ApiException extends Exception {

    /**
     * The HTTP status code that should be returned in respond to this exception.
     *
     * @since 1.0.0
     * @var integer $httpStatusCode
     */
    private int $httpStatusCode;

    /**
     * Optional details about the thrown error.
     *
     * @since 1.0.0
     * @var mixed[] $details
     */
    private array $details;

    /**
     * Creates a new ApiException with the specified arguments.
     * 
     * @api
     * @override
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param string $message The exception's message.
     * @param integer $code The exception's code.
     * @param integer $httpStatusCode The HTTP status code that should be returned in respond to this exception.
     * @param mixed[] $details Optional details about the thrown error.
     * @param \Throwable|null $previous The previous exception; i.e. the cause of this exception.
     */
    public function __construct(string $message, int $code = 0, int $httpStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR, array $details = [], ?Throwable $previous = null) {
        parent::__construct($message, $code);
        $this->httpStatusCode = $httpStatusCode;
        $this->details = $details;
    }

    /**
     * Gets the HTTP status code that should be returned in respond to this exception.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @return integer
     */
    public final function getHttpStatusCode(): int {
        return $this->httpStatusCode;
    }

    /**
     * Converts this ApiException instance to an array.
     * 
     * @api
     * @since 1.0.0
     * @version 1.1.0
     *
     * @param boolean $withDetails
     * @return mixed[]
     */
    public function toArray(bool $withDetails = false): array {
        return array_merge(
            [ 'message' => $this->getMessage(), 'code' => $this->getCode() ],
            !$withDetails || 0 == count($details = $this->details) ? [] : compact('details')
        );
    }
}