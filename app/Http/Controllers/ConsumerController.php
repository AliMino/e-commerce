<?php

namespace App\Http\Controllers;

use App\Services\ConsumerService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateUserRequest;

/**
 * Consumer Controller.
 * 
 * @api
 * @final
 * @version 1.0.0
 * @author Ali M. Kamel <ali.kamel.dev@gmail.com>
 */
final class ConsumerController extends ApiController {

    /**
     * @since 1.0.0
     * @var ConsumerService $consumerService
     */
    private ConsumerService $consumerService;

    /**
     * Creates a new ConsumerController instance on top of the specified ConsumerService instance.
     * 
     * @api
     * @final
     * @override
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param ConsumerService $consumerService
     */
    public final function __construct(ConsumerService $consumerService) {
        parent::__construct();
        $this->consumerService = $consumerService;
    }

    /**
     * Registers a new consumer.
     * 
     * @api
     * @final
     * @since 1.0.0
     * @version 1.0.0
     *
     * @param CreateUserRequest $request
     * @return JsonResponse
     */
    public final function createConsumer(CreateUserRequest $request): JsonResponse {
        return $this->getSuccessResponse(
            $this->consumerService->createConsumer(
                $request->input('name'),
                $request->input('email'),
                $request->input('password')
            )
        );
    }
}
