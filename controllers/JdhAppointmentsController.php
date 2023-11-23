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

class JdhAppointmentsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhappointmentslist[/{appointment_id}]", [PermissionMiddleware::class], "list.jdh_appointments")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhAppointmentsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhappointmentsadd[/{appointment_id}]", [PermissionMiddleware::class], "add.jdh_appointments")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhAppointmentsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhappointmentsview[/{appointment_id}]", [PermissionMiddleware::class], "view.jdh_appointments")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhAppointmentsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhappointmentsedit[/{appointment_id}]", [PermissionMiddleware::class], "edit.jdh_appointments")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhAppointmentsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhappointmentsdelete[/{appointment_id}]", [PermissionMiddleware::class], "delete.jdh_appointments")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhAppointmentsDelete");
    }
}
