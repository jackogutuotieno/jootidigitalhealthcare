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

class JdhPatientsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhpatientslist[/{patient_id}]", [PermissionMiddleware::class], "list.jdh_patients")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPatientsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhpatientsadd[/{patient_id}]", [PermissionMiddleware::class], "add.jdh_patients")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPatientsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhpatientsview[/{patient_id}]", [PermissionMiddleware::class], "view.jdh_patients")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPatientsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhpatientsedit[/{patient_id}]", [PermissionMiddleware::class], "edit.jdh_patients")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPatientsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhpatientsdelete[/{patient_id}]", [PermissionMiddleware::class], "delete.jdh_patients")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPatientsDelete");
    }
}
