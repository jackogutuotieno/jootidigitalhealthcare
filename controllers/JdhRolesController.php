<?php

namespace PHPMaker2024\jootidigitalhealthcare;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Delete;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Get;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Map;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Options;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Patch;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Post;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Put;

class JdhRolesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhroleslist[/{role_id}]", [PermissionMiddleware::class], "list.jdh_roles")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhRolesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhrolesadd[/{role_id}]", [PermissionMiddleware::class], "add.jdh_roles")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhRolesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhrolesview[/{role_id}]", [PermissionMiddleware::class], "view.jdh_roles")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhRolesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhrolesedit[/{role_id}]", [PermissionMiddleware::class], "edit.jdh_roles")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhRolesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhrolesdelete[/{role_id}]", [PermissionMiddleware::class], "delete.jdh_roles")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhRolesDelete");
    }
}
