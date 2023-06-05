<?php

namespace Codestoon\Orchestrator\User;

use App\Http\Controllers\Controller;
use Codestoon\Domains\User\DataTransformObjects\RegisterUserDataTransformObject;
use Codestoon\Infrastructure\User\Services\RegisterUserService;
use Codestoon\Presentation\User\Request\RegisterUserValidationRequest;
use Codestoon\Presentation\User\Response\RegisterUserResponse;
use Illuminate\Http\JsonResponse;

class UserOrchestrator extends Controller
{

    public function store(
        RegisterUserValidationRequest $request,
        RegisterUserDataTransformObject $registerUserDataTransformObject,
        RegisterUserService $registerUserService
    ): JsonResponse {

        $registerUserDataTransformObject->getDataFromRequest($request);

        $registerUserService($registerUserDataTransformObject);

        return (new RegisterUserResponse(null))
            ->response()->setStatusCode(201);
    }
}
