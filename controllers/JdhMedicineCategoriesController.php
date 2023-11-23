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

class JdhMedicineCategoriesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhmedicinecategorieslist[/{category_id}]", [PermissionMiddleware::class], "list.jdh_medicine_categories")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhMedicineCategoriesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhmedicinecategoriesadd[/{category_id}]", [PermissionMiddleware::class], "add.jdh_medicine_categories")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhMedicineCategoriesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhmedicinecategoriesview[/{category_id}]", [PermissionMiddleware::class], "view.jdh_medicine_categories")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhMedicineCategoriesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhmedicinecategoriesedit[/{category_id}]", [PermissionMiddleware::class], "edit.jdh_medicine_categories")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhMedicineCategoriesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhmedicinecategoriesdelete[/{category_id}]", [PermissionMiddleware::class], "delete.jdh_medicine_categories")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhMedicineCategoriesDelete");
    }
}
