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

class JdhPrescriptionsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhprescriptionslist[/{prescription_id}]", [PermissionMiddleware::class], "list.jdh_prescriptions")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPrescriptionsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhprescriptionsadd[/{prescription_id}]", [PermissionMiddleware::class], "add.jdh_prescriptions")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPrescriptionsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhprescriptionsview[/{prescription_id}]", [PermissionMiddleware::class], "view.jdh_prescriptions")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPrescriptionsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhprescriptionsedit[/{prescription_id}]", [PermissionMiddleware::class], "edit.jdh_prescriptions")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPrescriptionsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhprescriptionsdelete[/{prescription_id}]", [PermissionMiddleware::class], "delete.jdh_prescriptions")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPrescriptionsDelete");
    }
}
