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

class JdhStatusController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhstatuslist[/{status_id}]", [PermissionMiddleware::class], "list.jdh_status")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhStatusList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhstatusadd[/{status_id}]", [PermissionMiddleware::class], "add.jdh_status")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhStatusAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhstatusview[/{status_id}]", [PermissionMiddleware::class], "view.jdh_status")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhStatusView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhstatusedit[/{status_id}]", [PermissionMiddleware::class], "edit.jdh_status")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhStatusEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhstatusdelete[/{status_id}]", [PermissionMiddleware::class], "delete.jdh_status")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhStatusDelete");
    }
}
