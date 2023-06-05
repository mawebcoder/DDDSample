<?php

namespace Codestoon\Orchestrator\ACL;

use App\Http\Controllers\Controller;
use Codestoon\Domains\ACL\DataTransformObjects\RegisterRoleDataTransformObject;
use Codestoon\Domains\ACL\Services\RegisterRoleServiceInterface;
use Codestoon\Presentation\ACL\Requests\StoreRoleValidation;
use Codestoon\Presentation\ACL\Responses\RegisterRoleResponse;
use Illuminate\Http\JsonResponse;

class RoleOrchestrator extends Controller
{

    public function store(
        StoreRoleValidation $storeRoleValidation,
        RegisterRoleDataTransformObject $registerRoleDataTransformObject,
        RegisterRoleServiceInterface $registerRoleService
    ): JsonResponse {
        $registerRoleDataTransformObject->getDataFromRequest($storeRoleValidation);

        $registerRoleService($registerRoleDataTransformObject);

        return (new RegisterRoleResponse(null))
            ->response()->setStatusCode(201);
    }


}
