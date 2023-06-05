<?php

namespace Codestoon\Orchestrator\ACL;

use App\Http\Controllers\Controller;
use Codestoon\Domains\ACL\DataTransformObjects\RegisterRoleDataTransformObject;
use Codestoon\Domains\ACL\DataTransformObjects\UpdateRoleDataTransformObject;
use Codestoon\Domains\ACL\Services\DeleteRoleServiceInterface;
use Codestoon\Domains\ACL\Services\RegisterRoleServiceInterface;
use Codestoon\Domains\ACL\Services\UpdateRoleServiceInterface;
use Codestoon\Infrastructure\ACL\Services\DeleteRoleService;
use Codestoon\Infrastructure\ACL\Services\RegisterRoleService;
use Codestoon\Infrastructure\ACL\Services\UpdateRoleService;
use Codestoon\Presentation\ACL\Requests\StoreRoleValidation;
use Codestoon\Presentation\ACL\Requests\UpdateRoleValidation;
use Codestoon\Presentation\ACL\Responses\DeleteRoleResponse;
use Codestoon\Presentation\ACL\Responses\RegisterRoleResponse;
use Codestoon\Presentation\ACL\Responses\UpdateRoleResponse;
use Illuminate\Http\JsonResponse;
use Throwable;

class RoleOrchestrator extends Controller
{

    public function store(
        StoreRoleValidation $storeRoleValidation,
        RegisterRoleDataTransformObject $registerRoleDataTransformObject,
        RegisterRoleService $registerRoleService
    ): JsonResponse {
        $registerRoleDataTransformObject->getDataFromRequest($storeRoleValidation);

        $registerRoleService($registerRoleDataTransformObject);

        return (new RegisterRoleResponse(null))
            ->response()->setStatusCode(201);
    }


    /**
     * @throws Throwable
     */
    public function update(
        UpdateRoleValidation $updateRoleValidation,
        UpdateRoleDataTransformObject $updateRoleDataTransformObject,
        UpdateRoleService $updateRoleService
    ): UpdateRoleResponse {
        $updateRoleDataTransformObject->getDataFromRequest($updateRoleValidation);

        $updateRoleService($updateRoleDataTransformObject);

        return (new UpdateRoleResponse(null));
    }

    /**
     * @throws Throwable
     */
    public function delete($id, DeleteRoleService $deleteRoleService): DeleteRoleResponse
    {
        $deleteRoleService($id);

        return (new DeleteRoleResponse(null));
    }


}
