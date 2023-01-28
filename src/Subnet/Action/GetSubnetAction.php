<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Action;

use FRZB\Component\RequestMapper\Attribute\RequestBody;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use UnBlockerService\Common\Domain\Enum\HttpMethod;
use UnBlockerService\Subnet\Domain\Request\GetSubnetRequest;

#[AsController]
final class GetSubnetAction
{
    #[RequestBody(GetSubnetRequest::class, validationGroups: [GetSubnetRequest::class])]
    #[Route(name: self::class, methods: [HttpMethod::GET])]
    public function __invoke(GetSubnetRequest $request): Response
    {
        return new JsonResponse([]);
    }
}
