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

class JdhDepartmentsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhdepartmentslist[/{department_id}]", [PermissionMiddleware::class], "list.jdh_departments")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhDepartmentsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhdepartmentsadd[/{department_id}]", [PermissionMiddleware::class], "add.jdh_departments")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhDepartmentsAdd");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhdepartmentsedit[/{department_id}]", [PermissionMiddleware::class], "edit.jdh_departments")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhDepartmentsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhdepartmentsdelete[/{department_id}]", [PermissionMiddleware::class], "delete.jdh_departments")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhDepartmentsDelete");
    }
}
