<?php

namespace Codestoon\Orchestrator\ACL;

use App\Http\Controllers\Controller;
use Codestoon\Domains\ACL\DataTransformObjects\RegisterRoleDataTransformObject;
use Codestoon\Domains\ACL\DataTransformObjects\UpdateRoleDataTransformObject;
use Codestoon\Domains\ACL\Services\RegisterRoleServiceInterface;
use Codestoon\Domains\ACL\Services\UpdateRoleServiceInterface;
use Codestoon\Presentation\ACL\Requests\StoreRoleValidation;
use Codestoon\Presentation\ACL\Requests\UpdateRoleValidation;
use Codestoon\Presentation\ACL\Responses\RegisterRoleResponse;
use Codestoon\Presentation\ACL\Responses\UpdateRoleResponse;
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


    public function update(
        UpdateRoleValidation $updateRoleValidation,
        UpdateRoleDataTransformObject $updateRoleDataTransformObject,
        UpdateRoleServiceInterface $updateRoleService
    ): UpdateRoleResponse {
        $updateRoleDataTransformObject->getDataFromRequest($updateRoleValidation);

        $updateRoleService($updateRoleDataTransformObject);

        return (new UpdateRoleResponse(null));
    }


}
