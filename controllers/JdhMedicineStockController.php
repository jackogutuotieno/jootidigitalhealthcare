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

class JdhMedicineStockController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhmedicinestocklist[/{id}]", [PermissionMiddleware::class], "list.jdh_medicine_stock")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhMedicineStockList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhmedicinestockadd[/{id}]", [PermissionMiddleware::class], "add.jdh_medicine_stock")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhMedicineStockAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhmedicinestockview[/{id}]", [PermissionMiddleware::class], "view.jdh_medicine_stock")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhMedicineStockView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhmedicinestockedit[/{id}]", [PermissionMiddleware::class], "edit.jdh_medicine_stock")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhMedicineStockEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhmedicinestockdelete[/{id}]", [PermissionMiddleware::class], "delete.jdh_medicine_stock")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhMedicineStockDelete");
    }
}
