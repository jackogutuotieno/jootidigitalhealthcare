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

class JdhUsersController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhuserslist[/{user_id}]", [PermissionMiddleware::class], "list.jdh_users")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhUsersList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhusersadd[/{user_id}]", [PermissionMiddleware::class], "add.jdh_users")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhUsersAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhusersview[/{user_id}]", [PermissionMiddleware::class], "view.jdh_users")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhUsersView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhusersedit[/{user_id}]", [PermissionMiddleware::class], "edit.jdh_users")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhUsersEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhusersdelete[/{user_id}]", [PermissionMiddleware::class], "delete.jdh_users")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhUsersDelete");
    }
}
