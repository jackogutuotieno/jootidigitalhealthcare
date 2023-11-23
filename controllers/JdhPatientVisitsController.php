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

class JdhPatientVisitsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhpatientvisitslist[/{visit_id}]", [PermissionMiddleware::class], "list.jdh_patient_visits")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPatientVisitsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhpatientvisitsadd[/{visit_id}]", [PermissionMiddleware::class], "add.jdh_patient_visits")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPatientVisitsAdd");
    }
}
