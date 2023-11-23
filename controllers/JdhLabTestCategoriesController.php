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

class JdhLabTestCategoriesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhlabtestcategorieslist[/{test_category_id}]", [PermissionMiddleware::class], "list.jdh_lab_test_categories")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhLabTestCategoriesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhlabtestcategoriesadd[/{test_category_id}]", [PermissionMiddleware::class], "add.jdh_lab_test_categories")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhLabTestCategoriesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/jdhlabtestcategoriesview[/{test_category_id}]", [PermissionMiddleware::class], "view.jdh_lab_test_categories")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhLabTestCategoriesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhlabtestcategoriesedit[/{test_category_id}]", [PermissionMiddleware::class], "edit.jdh_lab_test_categories")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhLabTestCategoriesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhlabtestcategoriesdelete[/{test_category_id}]", [PermissionMiddleware::class], "delete.jdh_lab_test_categories")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhLabTestCategoriesDelete");
    }
}
