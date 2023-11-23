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

class JdhFacilityUnitsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhfacilityunitslist[/{id}]", [PermissionMiddleware::class], "list.jdh_facility_units")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhFacilityUnitsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhfacilityunitsadd[/{id}]", [PermissionMiddleware::class], "add.jdh_facility_units")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhFacilityUnitsAdd");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhfacilityunitsedit[/{id}]", [PermissionMiddleware::class], "edit.jdh_facility_units")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhFacilityUnitsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhfacilityunitsdelete[/{id}]", [PermissionMiddleware::class], "delete.jdh_facility_units")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhFacilityUnitsDelete");
    }
}
