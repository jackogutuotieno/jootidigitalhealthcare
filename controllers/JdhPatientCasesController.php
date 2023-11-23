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

class JdhPatientCasesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhpatientcaseslist[/{case_id}]", [PermissionMiddleware::class], "list.jdh_patient_cases")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPatientCasesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhpatientcasesadd[/{case_id}]", [PermissionMiddleware::class], "add.jdh_patient_cases")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPatientCasesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhpatientcasesview[/{case_id}]", [PermissionMiddleware::class], "view.jdh_patient_cases")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPatientCasesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhpatientcasesedit[/{case_id}]", [PermissionMiddleware::class], "edit.jdh_patient_cases")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPatientCasesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhpatientcasesdelete[/{case_id}]", [PermissionMiddleware::class], "delete.jdh_patient_cases")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPatientCasesDelete");
    }
}
