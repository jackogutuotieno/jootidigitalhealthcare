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

class JdhInsuranceController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhinsurancelist[/{insurance_id}]", [PermissionMiddleware::class], "list.jdh_insurance")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhInsuranceList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhinsuranceadd[/{insurance_id}]", [PermissionMiddleware::class], "add.jdh_insurance")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhInsuranceAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhinsuranceview[/{insurance_id}]", [PermissionMiddleware::class], "view.jdh_insurance")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhInsuranceView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhinsuranceedit[/{insurance_id}]", [PermissionMiddleware::class], "edit.jdh_insurance")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhInsuranceEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhinsurancedelete[/{insurance_id}]", [PermissionMiddleware::class], "delete.jdh_insurance")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhInsuranceDelete");
    }
}
