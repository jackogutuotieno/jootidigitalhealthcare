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

class JdhLabTestSubcategoriesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/jdhlabtestsubcategorieslist[/{test_subcategory_id}]", [PermissionMiddleware::class], "list.jdh_lab_test_subcategories")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhLabTestSubcategoriesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/jdhlabtestsubcategoriesadd[/{test_subcategory_id}]", [PermissionMiddleware::class], "add.jdh_lab_test_subcategories")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhLabTestSubcategoriesAdd");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/jdhlabtestsubcategoriesedit[/{test_subcategory_id}]", [PermissionMiddleware::class], "edit.jdh_lab_test_subcategories")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhLabTestSubcategoriesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/jdhlabtestsubcategoriesdelete[/{test_subcategory_id}]", [PermissionMiddleware::class], "delete.jdh_lab_test_subcategories")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "JdhLabTestSubcategoriesDelete");
    }
}
