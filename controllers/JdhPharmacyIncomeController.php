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

class JdhPharmacyIncomeController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhpharmacyincomelist[/{patient_id}]", [PermissionMiddleware::class], "list.jdh_pharmacy_income")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPharmacyIncomeList");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhpharmacyincomeview[/{patient_id}]", [PermissionMiddleware::class], "view.jdh_pharmacy_income")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhPharmacyIncomeView");
    }
}
