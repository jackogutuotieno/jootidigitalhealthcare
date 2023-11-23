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

class JdhWardsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhwardslist[/{ward_id}]", [PermissionMiddleware::class], "list.jdh_wards")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhWardsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhwardsadd[/{ward_id}]", [PermissionMiddleware::class], "add.jdh_wards")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhWardsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhwardsview[/{ward_id}]", [PermissionMiddleware::class], "view.jdh_wards")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhWardsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhwardsedit[/{ward_id}]", [PermissionMiddleware::class], "edit.jdh_wards")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhWardsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhwardsdelete[/{ward_id}]", [PermissionMiddleware::class], "delete.jdh_wards")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhWardsDelete");
    }
}
