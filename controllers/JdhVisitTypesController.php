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

class JdhVisitTypesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhvisittypeslist[/{visit_type_id}]", [PermissionMiddleware::class], "list.jdh_visit_types")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhVisitTypesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhvisittypesadd[/{visit_type_id}]", [PermissionMiddleware::class], "add.jdh_visit_types")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhVisitTypesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhvisittypesview[/{visit_type_id}]", [PermissionMiddleware::class], "view.jdh_visit_types")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhVisitTypesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhvisittypesedit[/{visit_type_id}]", [PermissionMiddleware::class], "edit.jdh_visit_types")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhVisitTypesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhvisittypesdelete[/{visit_type_id}]", [PermissionMiddleware::class], "delete.jdh_visit_types")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhVisitTypesDelete");
    }
}
