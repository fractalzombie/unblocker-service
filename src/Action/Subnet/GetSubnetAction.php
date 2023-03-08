<?php

declare(strict_types=1);

/*
 * UnBlocker service for routers.
 *
 * (c) Mykhailo Shtanko <fractalzombie@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UnBlockerService\Action\Subnet;

use FRZB\Component\RequestMapper\Attribute\RequestBody;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use UnBlockerService\Domain\Common\Enum\HttpMethod;
use UnBlockerService\Domain\Subnet\Request\GetSubnetRequest;

#[AsController]
final class GetSubnetAction extends AbstractController
{
    #[RequestBody(GetSubnetRequest::class, validationGroups: [GetSubnetRequest::class])]
    #[Route(name: self::class, methods: [HttpMethod::GET])]
    public function __invoke(GetSubnetRequest $request): Response
    {
        return $this->render('subnet_list.html.twig');
    }
}
