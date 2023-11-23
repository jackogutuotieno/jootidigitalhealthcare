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

class JdhDoctorChargesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhdoctorchargeslist[/{id}]", [PermissionMiddleware::class], "list.jdh_doctor_charges")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhDoctorChargesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhdoctorchargesadd[/{id}]", [PermissionMiddleware::class], "add.jdh_doctor_charges")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhDoctorChargesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhdoctorchargesview[/{id}]", [PermissionMiddleware::class], "view.jdh_doctor_charges")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhDoctorChargesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhdoctorchargesedit[/{id}]", [PermissionMiddleware::class], "edit.jdh_doctor_charges")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhDoctorChargesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhdoctorchargesdelete[/{id}]", [PermissionMiddleware::class], "delete.jdh_doctor_charges")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhDoctorChargesDelete");
    }
}
