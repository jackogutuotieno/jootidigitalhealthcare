<?php

namespace PHPMaker2024\jootidigitalhealthcare;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Delete;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Get;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Map;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Options;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Patch;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Post;
use PHPMaker2024\jootidigitalhealthcare\Attributes\Put;

/**
 * Patient_Appointments controller
 */
class PatientAppointmentsController extends ControllerBase
{
    // calendar
    #[Map(["GET", "POST", "OPTIONS"], "/patientappointments", [PermissionMiddleware::class], "calendar.Patient_Appointments")]
    public function calendar(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientAppointmentsCalendar");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/patientappointmentsadd[/{appointment_id}]", [PermissionMiddleware::class], "add.Patient_Appointments")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientAppointmentsAdd");
    }

    // view
    #[Map(["GET","OPTIONS"], "/patientappointmentsview[/{appointment_id}]", [PermissionMiddleware::class], "view.Patient_Appointments")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientAppointmentsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/patientappointmentsedit[/{appointment_id}]", [PermissionMiddleware::class], "edit.Patient_Appointments")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientAppointmentsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/patientappointmentsdelete[/{appointment_id}]", [PermissionMiddleware::class], "delete.Patient_Appointments")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PatientAppointmentsDelete");
    }
}
